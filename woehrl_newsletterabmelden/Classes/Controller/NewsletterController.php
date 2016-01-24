<?php
namespace WOEHRL\WoehrlNewsletterabmelden\Controller;

    /***************************************************************
     *
     *  Copyright notice
     *
     *  (c) 2015 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
     *
     *  All rights reserved
     *
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/

/**
 * NewsletterController
 */


class NewsletterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /* Deaktiviert FlashMessage für Fehler
    * @see Tx_Extbase_MVC_Controller_ActionController::getErrorFlashMessage()
    */

    protected function getErrorFlashMessage() {
        return FALSE;
    }



    /**
     * action unsubscribe
     * @param \WOEHRL\WoehrlNewsletterabmelden\Domain\Model\Newsletter $Newsletter
     * @return void
     */

    public function unsubscribeAction(\WOEHRL\WoehrlNewsletterabmelden\Domain\Model\Newsletter $Newsletter = NULL)

    {
         //$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
       // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $Newsletter, 'result');

        if($Newsletter){



            $wsdl = 'https://websvc-custdata.woehrl.de/newsletter_mssql.wsdl';
            $client = new \SoapClient($wsdl,
                array(
                    "trace" => 0,
                    'exceptions' => 0
                )
            );
            $resalt = $client->nlUnsubscribe($Newsletter->getEmail());
            switch ($resalt) {
                case 2:
                   /* $daten = array(
                        'frequenz_zu_hoch' => $this->piVars['frequenz_zu_hoch'],
                        'inhalte_zu_wenig' => $this->piVars['inhalte_zu_wenig'],
                        'inhalte_nicht_interessant' => $this->piVars['inhalte_nicht_interessant'],
                        'abmeldung_voruebergehend' => $this->piVars['abmeldung_voruebergehend'],
                        'abmeldung_freifeld' => trim(htmlspecialchars($this->piVars['abmeldung_freifeld'])),
                        'email' => $email
                    );
                    $this->mailsenden($email);
                    $this->CreateAbmeldungUmfrage($daten);
                    */
                    $Newsletter->setMeldung('2');
                    $this->sendMail($Newsletter->getEmail());

                    break;
                case -1:
                    $this->addFlashMessage(
                        $messageBody = "<div class='alert alert-danger' role='alert'>
                        Die E-Mailadresse <b>".$Newsletter->getEmail()."</b> ist in unserer Datenbank nicht vorhanden!</div>",
                        $messageTitle = "",
                        $severity = \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
                        $storeInSession = FALSE
                    );
                    break;
                default:
                    if($Newsletter->setMeldung('default')){
                        $this->sendMail($Newsletter->getEmail());
                    }
            }
        }

        $this->view->assign('Newsletter', $Newsletter);
    }

    private function sendMail($abmelderEmail)
    {
        $Name = "WÖHRL Newsletter Abmeldung"; //senders name
        $email = "newsletter@woehrl.de"; //senders e-mail adress
        $recipient = "alexander.fuchs@woehrl.de";
        //$recipient = 'stefan.wohnlich@woehrl.de'; //recipient


        $mail_body = 'Die E-Mail-Adresse '.$abmelderEmail. ' wurde aus unserem Newsletter-Verteiler entfernt' ;

        $header  = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=ISO-8859-1\r\n";
        $header .= "From: ". utf8_decode($Name) . " <" . $email . ">\r\n";
        //$header .= "Bcc: alexander.fuchs@woehrl.de"."\r\n";
        $header .= "Reply-To: $email\r\n";

        return mail($recipient, utf8_decode($Name), utf8_decode($mail_body), $header);

    }

}