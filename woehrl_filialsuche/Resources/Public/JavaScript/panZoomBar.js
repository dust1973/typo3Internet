//----------------------------------------------------------------------------
//	Parameter "minZoom"	verkuerzt den Slideranzeigebereich
//				manipuliert aber *nicht* map.zoom
//
//	Funktion von Mouseradzoom und "zoomout"-Button bleiben unangetastet
//----------------------------------------------------------------------------

OpenLayers.Control.PanZoomBar=OpenLayers.Class(OpenLayers.Control.PanZoom, {

    zoomStopWidth:18,
    zoomStopHeight:11,
    minZoom:0,
    slider:null,
    sliderEvents:null,
    zoombarDiv:null,
    divEvents:null,
    zoomWorldIcon:false,
    forceFixedZoomLevel:false,
    mouseDragStart:null,
    zoomStart:null,

    initialize:function(){
        OpenLayers.Control.PanZoom.prototype.initialize.apply(this,arguments);
    },

    destroy:function() {
        this._removeZoomBar();
        this.map.events.un( {
            "changebaselayer":this.redraw,scope:this
        });
        OpenLayers.Control.PanZoom.prototype.destroy.apply(this,arguments);
        delete this.mouseDragStart;
        delete this.zoomStart;
    },

    setMap:function(map) {
        OpenLayers.Control.PanZoom.prototype.setMap.apply(this,arguments);
        this.map.events.register("changebaselayer",this,this.redraw);
    },

    redraw:function() {
        if(this.div) {
            this.removeButtons();
            this._removeZoomBar();
        }
        this.draw();
    },

    draw:function(px) {
        OpenLayers.Control.prototype.draw.apply(this,arguments);
        px=this.position.clone();
        this.buttons=[];
        var sz=new OpenLayers.Size(18,18);
        var centered=new OpenLayers.Pixel(px.x+sz.w/2,px.y);
        var wposition=sz.w;
        if(this.zoomWorldIcon) {
            centered=new OpenLayers.Pixel(px.x+sz.w,px.y);
        }
        this._addButton("panup","north-mini.png",centered,sz);
        px.y=centered.y+sz.h;
        this._addButton("panleft","west-mini.png",px,sz);
        if(this.zoomWorldIcon) {
            this._addButton("zoomworld","zoom-world-mini.png",px.add(sz.w,0),sz);
            wposition*=2;
        }
        this._addButton("panright","east-mini.png",px.add(wposition,0),sz);
        this._addButton("pandown","south-mini.png",centered.add(0,sz.h*2),sz);
        this._addButton("zoomin","zoom-plus-mini.png",centered.add(0,sz.h*3+5),sz);
        centered=this._addZoomBar(centered.add(0,sz.h*4+5));
        this._addButton("zoomout","zoom-minus-mini.png",centered,sz);
        return this.div;
    },

    _addZoomBar:function(centered) {
        var imgLocation=OpenLayers.Util.getImagesLocation();
        var id=this.id+"_"+this.map.id;
        var zoomsToEnd=this.map.getNumZoomLevels()-1-this.map.getZoom();
        var slider=OpenLayers.Util.createAlphaImageDiv(id,centered.add(-1,zoomsToEnd*this.zoomStopHeight),new OpenLayers.Size(20,9),imgLocation+"slider.png","absolute");
        this.slider=slider;
        this.sliderEvents=new OpenLayers.Events(this,slider,null,true, {
            includeXY:true
        });
        this.sliderEvents.on( {
            "mousedown":this.zoomBarDown,
            "mousemove":this.zoomBarDrag,
            "mouseup":this.zoomBarUp,
            "dblclick":this.doubleClick,
            "click":this.doubleClick
        });
        var sz=new OpenLayers.Size();
        sz.h=this.zoomStopHeight*Math.max(this.map.getNumZoomLevels()-this.minZoom,1);
        sz.w=this.zoomStopWidth;
        var div=null;
        if(OpenLayers.Util.alphaHack()) {
            id=this.id+"_"+this.map.id;
            div=OpenLayers.Util.createAlphaImageDiv(id,centered,new OpenLayers.Size(sz.w,this.zoomStopHeight),imgLocation+"zoombar.png","absolute",null,"crop");
            div.style.height=sz.h+"px";
        }else {
            div=OpenLayers.Util.createDiv('OpenLayers_Control_PanZoomBar_Zoombar'+this.map.id,centered,sz,imgLocation+"zoombar.png");
        }
        this.zoombarDiv=div;
        this.divEvents=new OpenLayers.Events(this,div,null,true, {
            includeXY:true
        });
        this.divEvents.on( {
            "mousedown":this.divClick,
            "mousemove":this.passEventToSlider,
            "dblclick":this.doubleClick,
            "click":this.doubleClick
        });
        this.div.appendChild(div);
        this.startTop=parseInt(div.style.top, 10);
        this.div.appendChild(slider);
        this.map.events.register("zoomend",this,this.moveZoomBar);
        centered=centered.add(0,this.zoomStopHeight*Math.max(this.map.getNumZoomLevels()-this.minZoom,1));
        return centered;
    },

    _removeZoomBar:function() {
        this.sliderEvents.un( {
            "mousedown":this.zoomBarDown,
            "mousemove":this.zoomBarDrag,
            "mouseup":this.zoomBarUp,
            "dblclick":this.doubleClick,
            "click":this.doubleClick
        });
        this.sliderEvents.destroy();
        this.divEvents.un( {
            "mousedown":this.divClick,
            "mousemove":this.passEventToSlider,
            "dblclick":this.doubleClick,
            "click":this.doubleClick
        });
        this.divEvents.destroy();
        this.div.removeChild(this.zoombarDiv);
        this.zoombarDiv=null;
        this.div.removeChild(this.slider);
        this.slider=null;
        this.map.events.unregister("zoomend",this,this.moveZoomBar);
    },

    passEventToSlider:function(evt) {
        this.sliderEvents.handleBrowserEvent(evt);
    },

    divClick:function(evt) {
        if(!OpenLayers.Event.isLeftClick(evt)) {
            return;
        }
        var y=evt.xy.y;
        var top=OpenLayers.Util.pagePosition(evt.object)[1];
        var levels=(y-top)/this.zoomStopHeight;
        if(this.forceFixedZoomLevel||!this.map.fractionalZoom) {
            levels=Math.floor(levels);
        }
        var zoom=(this.map.getNumZoomLevels()-1)-levels;
        zoom=Math.min(Math.max(zoom,0),this.map.getNumZoomLevels()-1);
        this.map.zoomTo(zoom);
        OpenLayers.Event.stop(evt);
    },

    zoomBarDown:function(evt) {
        if(!OpenLayers.Event.isLeftClick(evt)) {
            return;
        }
        this.map.events.on( {
            "mousemove":this.passEventToSlider,
            "mouseup":this.passEventToSlider,
            scope:this
        });
        this.mouseDragStart=evt.xy.clone();
        this.zoomStart=evt.xy.clone();
        this.div.style.cursor="move";
        this.zoombarDiv.offsets=null;
        OpenLayers.Event.stop(evt);
    },

    zoomBarDrag:function(evt) {
        if(this.mouseDragStart) {
            var deltaY=this.mouseDragStart.y-evt.xy.y;
            var offsets=OpenLayers.Util.pagePosition(this.zoombarDiv);
            if((evt.clientY-offsets[1])>0&&(evt.clientY-offsets[1])<parseInt(this.zoombarDiv.style.height, 10)-2) {
                var newTop=parseInt(this.slider.style.top, 10)-deltaY;
                this.slider.style.top=newTop+"px";
                this.mouseDragStart=evt.xy.clone();
            }
            OpenLayers.Event.stop(evt);
        }
    },

    zoomBarUp:function(evt) {
        if(!OpenLayers.Event.isLeftClick(evt)) {
            return;
        }
        if(this.mouseDragStart) {
            this.div.style.cursor="";
            this.map.events.un( {
                "mouseup":this.passEventToSlider,
                "mousemove":this.passEventToSlider,
                scope:this
            });
            var deltaY=this.zoomStart.y-evt.xy.y;
            var zoomLevel=this.map.zoom;
            if(!this.forceFixedZoomLevel&&this.map.fractionalZoom) {
                zoomLevel+=deltaY/this.zoomStopHeight;
                zoomLevel=Math.min(Math.max(zoomLevel,0),this.map.getNumZoomLevels()-1);
            }else {
                zoomLevel+=Math.round(deltaY/this.zoomStopHeight);
            }
            this.map.zoomTo(Math.max(zoomLevel, this.minZoom));
            this.mouseDragStart=null;
            this.zoomStart=null;
            OpenLayers.Event.stop(evt);
            this.moveZoomBar();
        }
    },

    moveZoomBar:function() {
        var newTop=((this.map.getNumZoomLevels()-1)-Math.max(this.map.getZoom(),this.minZoom))*this.zoomStopHeight+this.startTop+1;
        this.slider.style.top=newTop+"px";
    },

    CLASS_NAME:"OpenLayers.Control.PanZoomBar"
});







