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
class AnredeValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * @param mixed $value
     *
     * @return bool|void
     */

    public function isValid($value)
    {
        $this->errors = array();
       // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $value, 'AGB');
        if( ($value != 1) OR ($value !=2)) {
            $this->addError(
                'Um Sie persönlich ansprechen zu können, benötigen wir Ihre Anrede.',
                1806198601,
                array( htmlspecialchars($value))
            );
            return false;

        }
        return true;
    }
}
?>