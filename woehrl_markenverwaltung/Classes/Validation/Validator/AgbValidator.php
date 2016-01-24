<?php
/**
 * Created by PhpStorm.
 * User: fuchsa
 * Date: 16.02.2015
 * Time: 10:21
 */

namespace WOEHRL\WoehrlStylecardantrag\Validation\Validator;

class AgbValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * @param mixed $property
     *
     * @return bool|void
     */

    public function isValid($property) {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($property, 'errors');
        $agb = $this->options['agb'];
        if ($agb) {
            return TRUE;
        }
        $this->addError(
            'AGB Fehler',
            1393152387,
            array( htmlspecialchars($property))
        );
        return FALSE;
    }

}