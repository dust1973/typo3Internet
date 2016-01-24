<?php
namespace WOEHRL\WoehrlKassenbongewinnspiel\Validation\Validator;

/**
 * Created by PhpStorm.
 * User: fuchsa
 * Date: 12.02.2015
 * Time: 16:10
 */


use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use WOEHRL\WoehrlGewinnspiele\Domain\Model\Teilnehmer;
/**
 *
 *
 * @package Newsletter
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class EmailValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {


    /**
     * teilnehmerRepository
     *
     * @var \WOEHRL\WoehrlKassenbongewinnspiel\Domain\Repository\TeilnehmerRepository
     * @inject
     */
    protected $teilnehmerRepository = NULL;


    /**
     * @param mixed $value
     * @return bool|void
     */

    public function isValid($value)
    {
        $this->errors = array();

        $email = $this->teilnehmerRepository->findByEmail(trim(strtolower($value)));
       // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $value , 'Email Validator');
        if($email) {
            $this->addError(
                'Die E-Mail-Adresse <b>' . $email. '</b> ist bereits registriert.',
                1806198601,
                array( htmlspecialchars($value))
            );
            return false;

        }
        return true;
    }
}
?>