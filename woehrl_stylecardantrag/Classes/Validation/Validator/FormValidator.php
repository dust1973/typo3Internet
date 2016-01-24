<?php
namespace WOEHRL\WoehrlStylecardantrag\Validation\Validator;
/**
 * Created by PhpStorm.
 * User: fuchsa
 * Date: 12.02.2015
 * Time: 16:10
 */


use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use WOEHRL\WoehrlStylecardantrag\Domain\Model\Stylecardantrag;
/**
 *
 *
 * @package stylecardantrag
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FormValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * @param mixed $property
     *
     * @return bool|void
     */

    public function isValid($value)
    {
        $this->errors = array();

        if( strlen($value) < 3 ) {
            $this->addError(
                'Der Wert ist zu kurz (mind. 3 Zeichen)',
                1806198601,
                array( htmlspecialchars($value))
            );
            return false;

        } elseif( strlen($value) > 10 ) {
            $this->addError(
                'Der Wert ist zu kurz (max. 10 Zeichen)',
                1806198602,
                array( htmlspecialchars($value))
            );
            return false;
        }

        return true;
    }
}
?>