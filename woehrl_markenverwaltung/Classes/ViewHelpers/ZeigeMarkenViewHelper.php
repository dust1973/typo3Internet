<?php
/**
 * Created by PhpStorm.
 * User: fuchsa
 * Date: 04.02.2015
 * Time: 17:21
 */
namespace Woehrl\WoehrlMarkenverwaltung\ViewHelpers;


class ZeigeMarkenViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper {


    /**
     * ZeigeMarken
     * @param string $marke
     * @param string $anfangsbuchstabe
     * @param int $anzahl
     * @param int $iteration
     * @return string
     */



    public function render($marke, $anzahl, $iteration, $anfangsbuchstabe) {

        $marke = '<b>'.$marke.'</b>';
        if($anzahl <5 ){
            switch ($anzahl) {

                case 1:
                    $result = '<div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12 first" id="marken'.$anfangsbuchstabe.'">
                                        <span class="badge">'. $anfangsbuchstabe. '</span></div><div class="col-lg-3 col-xs-12 col-xm-12">'.$marke.'</div>
                                        </div><hr />';
                    break;

                default:

                    if ((($iteration % 4) == 1) AND (($anzahl-$iteration) != 0)) {
                        $result = '<div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12 first" id="marken'.$anfangsbuchstabe.'">
                                        <span class="badge">'. $anfangsbuchstabe. '</span></div><div class="col-lg-3 col-xs-12 col-xm-12">'.$marke.'</div>
                                        ';
                    }elseif (($anzahl - $iteration) == 0){
                        $result = '<div class="col-lg-2 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                    }else{
                        $result = '<div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                    }

            }


        }else{
                switch ($iteration) {
                    case 1:

                      if($iteration != $anzahl) {
                          $result = '<div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12 first" id="marken'.$anfangsbuchstabe.'">
                                        <span class="badge">'. $anfangsbuchstabe. '</span></div><div class="col-lg-3 col-xs-12 col-xm-12">'.$marke.'</div>
                                        ';
                      }else{
                          $result = '<div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12 first" id="marken'.$anfangsbuchstabe.'">
                                        <span class="badge">'. $anfangsbuchstabe. '</span></div><div class="col-lg-3 col-xs-12 col-xm-12">'.$marke.'</div>
                                        </div><hr />';

                      }
                     // $result = "<h2>Case 1 -- Modulo 4: " . $iteration % 4 . "---Gesamt " .$anzahl . "---". $iteration . " Marke: ". $marke . "</h2>";
                        break;
                    case 2:
                            $result = '<div class="col-lg-3 col-xs-12 col-xm-12">'.$marke.'</div>';
                        break;

                    case 3:
                            $result = '<div class="col-lg-3 col-xs-12 col-xm-12">'.$marke.'</div>';
                        break;

                    case 4:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke . '</div></div>';
                        }else{
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                        }
                        break;
                    case 5:
                        if($iteration != $anzahl) {
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                        }
                        break;
                    case 6:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                        }
                        break;
                    case 7:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                        }
                        break;
                    case 8:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div>';
                        }else{
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 9:
                        if($iteration != $anzahl) {
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 10:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 11:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 12:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div>';
                        }else{
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 13:
                        if($iteration != $anzahl) {
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div>';
                        }else{
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 14:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 15:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 16:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke . '</div></div>';
                        }else{
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 17:
                        if($iteration != $anzahl) {
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 18:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 19:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 20:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div>';
                        }else{
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                        }
                        break;
                    case 21:
                        if($iteration != $anzahl) {
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 22:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 23:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 24:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div>';
                        }else{
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                        }
                        break;
                    case 25:
                        if($iteration != $anzahl) {
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 26:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 27:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 28:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div>';
                        }else{
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                        }
                        break;
                    case 29:
                        if($iteration != $anzahl) {
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 30:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 31:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 32:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div>';
                        }else{
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                        }
                        break;
                    case 33:
                        if($iteration != $anzahl) {
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="row">
                                        <div class="col-lg-1 col-xs-12 col-xm-12"></div><div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 34:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 35:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                        }else{
                            $result = ' <div class="col-lg-3 col-xs-12 col-xm-12">' . $marke .'</div></div><hr />';
                        }
                        break;
                    case 36:
                        if($iteration != $anzahl) {
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke .'</div></div>';
                        }else{
                            $result = ' <div class="col-lg-2 col-xs-12 col-xm-12">' . $marke . '</div></div><hr />';
                        }
                        break;

                    default:
                        break;
                        //$result = "<h2>Modulo 4: " . $iteration % 4 . "---Gesamt " .$anzahl . "---". $iteration . " Marke: ". $marke . "</h2>";

                }


              // $result = '<div class="col-lg-3 col-xs-12 col-xm-12">' . $marke . '</div>';
                //$result = "<h2>Modulo 4: " . $iteration % 4 . "---Gesamt " .$anzahl . "---". $iteration . " Marke: ". $marke . "</h2>";
            }








        return  $result;


    }
}