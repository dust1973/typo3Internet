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
class GeburtsdatumValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * @param mixed $value
     *
     * @return bool|void
     */

    public function isValid($value)
    {
        $this->errors = array();

        $birthday = strtotime($value);
        $Minus18jahre = (strtotime('-18 Year'));
       // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(  $Minus18jahre , 'eburtsdatumValidator');
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $birthday , 'eburtsdatumValidator');

        if( $birthday > $Minus18jahre ) {
            $this->addError(
                'Teilnahmeberechtigt sind Personen ab 18 Jahren',
                1806198601,
                array( htmlspecialchars($value))
            );
            return false;

        }
        return true;
    }
}
?>