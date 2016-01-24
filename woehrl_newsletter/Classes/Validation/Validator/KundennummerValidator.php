<?php
namespace WOEHRL\WoehrlNewsletter\Validation\Validator;
/**
 * Created by PhpStorm.
 * User: fuchsa
 * Date: 12.02.2015
 * Time: 16:10
 */


use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter;
/**
 *
 *
 * @package Newsletter
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class KundennummerValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * @param mixed $property
     *
     * @return bool|void
     */

    public function isValid($value)
    {
        $this->errors = array();

        if( strlen($value) < 7 ) {
            $this->addError(
                'Die Kundennummer muss 7-stellig sein',
                1806198601,
                array( htmlspecialchars($value))
            );
            return false;

        } elseif( strlen($value) > 7 ) {
            $this->addError(
                'Die Kundennummer muss 7-stellig sein',
                1806198602,
                array( htmlspecialchars($value))
            );
            return false;
        }

        return true;
    }
}
