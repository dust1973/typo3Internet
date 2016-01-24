<?php
namespace BK2K\BootstrapPackage\ViewHelpers;

/***************************************************************
 *
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2014 Benjamin Kott, http://www.bk2k.info
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 *
 ***************************************************************/

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class FormnlViewHelper extends AbstractViewHelper {

    /**
     * Keep the parent from preparing the TagBuilder.
     *
     * @return void
     */
    public function initialize() {}

    /**
     * Initialize the arguments.
     *
     * @return void
     * @api
     */
    public function initializeArguments() {
        $this->registerArgument('property', 'string', 'Name of property (of the object bound to the form) to configure', TRUE);
        $this->registerArgument('allowProperties', 'string', 'List property names (comma separated) to map onto the property given in forProperty', TRUE);
        $this->registerArgument('count', 'int', '', FALSE, 1);
    }

    /**
     * Does not render anything, just tweaks configuration.
     *
     * @return string
     * @api
     */
    public function render() {
        $name = $this->arguments['property']; //$this->getName();
        $allowedPropertyNames = \TYPO3\CMS\Extbase\Utility\ArrayUtility::trimExplode(',', $this->arguments['allowProperties']);

        foreach ($allowedPropertyNames as $allowedPropertyName) {

            for($i=0; $i<=$this->arguments['count']; $i++) {
                $this->registerFieldNameForFormTokenGeneration($name . '[' . $allowedPropertyName . ']');
            }


        }

        return '';
    }

}