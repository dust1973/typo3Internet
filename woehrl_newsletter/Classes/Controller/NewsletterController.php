<?php
namespace WOEHRL\WoehrlNewsletter\Controller;

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

use WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter;

require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_newsletter') . '/Classes/Barcode/BCGColor.php';
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_newsletter') . '/Classes/Barcode/BCGBarcode.php';
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_newsletter') . '/Classes/Barcode/BCGDrawing.php';
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_newsletter') . '/Classes/Barcode/BCGFontFile.php';
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_newsletter') . '/Classes/Barcode/BCGcode128.php';

class NewsletterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * NewsletterRepository
     *
     * @var \WOEHRL\WoehrlNewsletter\Domain\Repository\NewsletterRepository
     * @inject
     */
    protected $NewsletterRepository = NULL;

    /* Deaktiviert FlashMessage für Fehler
    * @see Tx_Extbase_MVC_Controller_ActionController::getErrorFlashMessage()
    */
    protected function getErrorFlashMessage() {
        return FALSE;
    }

    /**
     * formAction benötigt ein Objekt, string muss erst umgewandelt werden.
     * Als Request (GET/POST) wird die Umwandlung automatisch gemacht.
     * @return void
     */
    public function initializeformAction() {

       if($this->arguments->hasArgument('Newsletter')){
            $arg = $this->request->getArguments();
            $email = $arg['Newsletter']['email'];
            $propertyMappingConfiguration = $this->arguments->getArgument('Newsletter')->getPropertyMappingConfiguration();
            $propertyMappingConfiguration->allowAllProperties();
           // $propertyMappingConfiguration->allowProperties('email');
           $Newsletter = new \WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter;
           $Newsletter->setEmail($email);
           // $this->request->setArguments('Newsletter',  $arg);

            $propertyMappingConfiguration->setTypeConverterOption(
                'TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter',
                \TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED, TRUE);
           //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $Newsletter, 'args');
           // $this->view->assign('Newsletter', $Newsletter);
        }
    }


    /**
     * action form
     * @param \WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter $Newsletter
     * @return void
     */

    public function formAction(\WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter $Newsletter = NULL)

    {

        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $Newsletter, 'args');
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $args['email'], 'args');
        //$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $Newsletter, 'result');
        
        if ($Newsletter) {

           if($Newsletter->isKindermode()){
                $kindermode = 1;
            }else{
               $kindermode = 0;
           }
            if($Newsletter->isHerrenmode()){
                $herrenmode = 1;
            }else{
                $herrenmode = 0;
            }
            if($Newsletter->isDamenmode()){
                $damenmode = 1;
            }else{
                $damenmode = 0;
            }


            $result = $this->getWSDL()->emailAnlegen(
                            $Newsletter->getAnrede(),
                            $Newsletter->getTitel(),
                            $Newsletter->getEmail(),
                            ucwords($Newsletter->getVorname()),
                            ucwords($Newsletter->getNachname()),
                            $bestand = 'normal',
                            $Newsletter->getKundennummer(),
                            $Newsletter->getPlz(),
                            $kindermode,
                            $herrenmode,
                            $damenmode
                        );


                if($result){

                    $subject = "Herzlich Willkommen bei WÖHRL"; //subject
                    $controllerName = 'Newsletter';
                    $gender = '';
                    $gender = $Newsletter->getAnrede();




                        switch ($result) {
                            case 50000:
                                //--Diese E-Mail-Adresse ist bereits registriert.
                                $this->addFlashMessage(
                                    $messageBody = "<div class='alert alert-danger' role='alert'>Fehler: Es ist bereits ein Benutzer mit der E-Mail-Adresse <b>".$Newsletter->getEmail()."</b> registriert!</div>",
                                    $messageTitle = "",
                                    $severity = \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
                                    $storeInSession = FALSE
                                );
                                break;
                            case -2:
                                break;
                            default:
                                //Durch eine erfolgreiche Anmeldung wird eine 34 Stellige $Identifikationsnummer zurückgeliefert

                                $link = $this
                                    ->controllerContext
                                    ->getUriBuilder()
                                    ->reset()
                                    ->setArguments(array(
                                            'tx_woehrlnewsletter_pi1[action]' => 'subscribe',
                                            'tx_woehrlnewsletter_pi1[key]' => $result)
                                    )
                                    ->setTargetPageUid($this->settings['list_detail_pid'])
                                    ->setCreateAbsoluteUri(true)
                                    ->buildFrontendUri();

                                $htmlTemplate =  $this->getTemplateHtml($controllerName, 'Email',
                                    $optMarkers= array(
                                        'EmpfaengerEmail' =>$Newsletter->getEmail(),
                                        'BestaetigungLink' =>$link,
                                        'Anrede' =>$gender,
                                        'Vorname' =>ucwords($Newsletter->getVorname()),
                                        'Nachname' =>ucwords($Newsletter->getNachname()),
                                    )
                                );


                                if($this->sendMail($result, $Newsletter->getEmail(), $htmlTemplate, $subject)){
                                    $Newsletter->setMeldung('2');
                                }

                        }
                }

        }

        $this->view->assign('Newsletter', $Newsletter);
    }

    /**
     * action subscribe
     *
     * @return void
     */
    public function subscribeAction()
    {

        if($this->request->hasArgument('key')) {
            $args = $this->request->getArguments();
            $key = $args['key'];

            $result = $this->getWSDL()->aboAktivieren($key);
            //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $result, 'wsdl');
            //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $this->request->getArguments('key'), 'Newsletter');
           // die;


            //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $Newsletter, 'Newsletter');
            //die;

            switch ($result) {
                case 9:
                    // -9 Kunden aktivieren
                    $GutscheinaktionIdentifikation = 'D735B632-B38C-E311-AAF1-003048CEE820';

                    $code =$this->getWSDL()->Gutscheinerzeugung($key, $GutscheinaktionIdentifikation);

                    if ($code->item) {
                        switch ($code->item[0]->key) {
                            case 'GutscheinBereitsAusgestellt' :
                                //-2 Gutschein wurde bereits fuer den Kunden ausgestellt ( Gutschein fuer KundeUid und Gutscheinaktion bereits vorhanden)
                                //echo t3lib_utility_Debug::debug($code->item[0]->key, 'case -2');
                                break;

                            case 'KundeOderGutscheinaktionNichtDefiniert' :
                                //-1 Kunde oder Gutscheinaktion nicht definiert
                                //echo t3lib_utility_Debug::debug($code->item[0]->key, 'case -1');
                                break;

                            case 'Gutscheinbarcode' :
                                $barcode = $code->item[0]->value;
                                $GueltigAb = $code->item[2]->value;
                                $GueltigBis = $code->item[4]->value;
                                //echo t3lib_utility_Debug::debug($code->item[4]->value, 'GueltigBis');
                                if ($kdaten = $this->getWSDL()->getEMailByUidHash($key)) {
                                    //echo t3lib_utility_Debug::debug($kdaten, '$kdaten');
                                    $this->Gutschein5EuroErzeigenUndAlsPdfVersenden($key, $kdaten->email);
                                }
                                break;

                            default :
                        }

                    }
                    $error = 2;
                    break;
                case -2:
                    //-2 Kunde bereits aktiviert
                    $error = 4;
                    break;

                case -3:
                    //-3 Kunde in Tabelle nicht vorhanden.
                    $error = 5;
                    break;

                default:
                    //Der Dienst zur zeit nicht Verfügbar, versuchen Sie es später noch einmal.
                    $error = 6;
                    break;
            }

            $this->view->assign('content', $error);
        }
    }


    private function sendMail($uid, $mailto , $mailtemplateFile, $subject)
    {
        $Name = "WÖHRL Newsletter"; //senders name
        $email = "newsletter@woehrl.de"; //senders e-mail adress
        //$mailto = "alexander.fuchs@woehrl.de";
        $recipient = $mailto; //recipient


        $mail_body = $mailtemplateFile;

        $header  = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=ISO-8859-1\r\n";
        $header .= "From: ". utf8_decode($Name) . " <" . $email . ">\r\n";
       //$header .= "Bcc: alexander.fuchs@woehrl.de"."\r\n";
        $header .= "Reply-To: $email\r\n";

        return mail($recipient, utf8_decode($subject), utf8_decode($mail_body), $header);

    }

    private function pruefen($kdnr){

        $strStylecardNr = (string) $kdnr ;
        $zwsum = 0;
        $zw = 0;
        $pz = 0;
        $i = 0;

        for ($i = strlen($strStylecardNr); $i > 0; $i--){

            $zw = intval((substr($strStylecardNr,$i - 1, 1)));
            $zw = intval ($zw * (($i % 2) + 1));
            $zws = (string) $zw;
            $zw = 0;
            for ($j = 1; $j <= strlen($zws); $j++)
                $zw = $zw + intval(substr($zws,$j - 1, 1));
            $zwsum = $zwsum + $zw;
        }
        $zws = (string) $zwsum;
        $pz = intval(substr($zws,(strlen($zws) - 1), 1));
        $pz = 10 - $pz;
        if ($pz == 10)
            $pz = 0;

        return $pz;

    }

    public function code128($kdnr, $vorname, $nachname, $gender)
    {

        $barcode = 'S' . $kdnr;
        $oo = 1;
        $pruefziffer = $this->pruefen($kdnr);
        $label = $kdnr . ' ' . $pruefziffer;
        $f1 = 'Arial.ttf';
        $f2 = 8;
        $a1 = '';
        $a2 = NULL;
        $a3 = '';
        $t = 50;
        $r = 1;

        if ($f1 !== '0' && $f1 !== '-1' && intval($f2) >= 1) {
            //$font = new BCGFontFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_newsletter') . '/Classes/Barcode/Font'. $f1, intval($f2));
            $font = new \BCGFontFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_newsletter') . 'Classes/Barcode/Font/'. $f1, intval($f2));
            } else {
                $font = 0;
        }

            $color_black = new \BCGColor(0, 0, 0);
            $color_white = new \BCGColor(255, 255, 255);
            $codebar = 'BCGcode128';

            $drawException = null;
            try {
                $code_generated = new $codebar();

                if (isset($a1) && intval($a1) === 1) {
                    $code_generated->setChecksum(true);
                }
                if (isset($a2) && !empty($a2)) {
                    $code_generated->setStart($a2 === 'NULL' ? null : $a2);
                }
                if (isset($a3) && !empty($a3)) {
                    $code_generated->setLabel($a3 === 'NULL' ? null : $a3);
                }
                $code_generated->setThickness($t);
                $code_generated->setScale($r);
                $code_generated->setBackgroundColor($color_white);
                $code_generated->setForegroundColor($color_black);
                $code_generated->setFont($font);
                $code_generated->setLabel($label);
                $code_generated->parse($barcode);

            } catch (Exception $exception) {
                $drawException = $exception;
            }
            $drawing = new \BCGDrawing('./uploads/tx_woehrlnewsletter/' . $kdnr . '.png', $color_white);

            if ($drawException) {
                $drawing->drawException($drawException);
            } else {

                $drawing->setBarcode($code_generated);
                $drawing->setRotationAngle('0');
                $drawing->setDPI('72');
                $drawing->draw();
            }
            $drawing->finish(intval($oo));

            $image1 = imageCreateFromjpeg("./typo3conf/ext/woehrl_newsletter/Resources/Public/Images/Woehrl-stylecard-Kundenkarte.jpg");
            $image2 = imageCreateFromPNG('./uploads/tx_woehrlnewsletter/' . $kdnr . '.png');

            imageCopy($image1, $image2,
                28, 125,
                0, 0,
                123, 62);
            $color = ImageColorAllocate($image1, 255, 255, 255);
           $font_file =  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_newsletter') . '/Classes/Barcode/Font/Arial.ttf';
            if (strlen($vorname . ' ' . $nachname) < 24) {
                imagefttext($image1, 11, 0, 25, 70, $color, $font_file, $gender);
                imagefttext($image1, 11, 0, 25, 90, $color, $font_file, $vorname . ' ' . $nachname);
            } else {
                imagefttext($image1, 11, 0, 25, 70, $color, $font_file, $gender);
                imagefttext($image1, 11, 0, 25, 90, $color, $font_file, $nachname);
            }
            imagefttext($image1, 11, 0, 25, 110, $color, $font_file, $kdnr);
            if (imagejpeg($image1, './uploads/tx_woehrlnewsletter/stylecard_' . $kdnr . '.jpg', 100)) {
                return './uploads/tx_woehrlnewsletter/stylecard_' . $kdnr . '.jpg';

            }

    }

    public function getTemplateHtml($controllerName, $templateName, $variables) {

        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $tempView */
        $tempView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
        $templatePathAndFilename = $templateRootPath . $controllerName . '/' . $templateName . '.html';
        $tempView->setTemplatePathAndFilename($templatePathAndFilename);
        $tempView->assignMultiple($variables);
        $tempHtml = $tempView->render();

        return $tempHtml;
    }

    private function getWSDL(){

        $wsdl = 'https://websvc-custdata.woehrl.de/newsletter_mssql.wsdl';
        $client = new \SoapClient($wsdl,
            array(
                "trace" => 0,
                'exceptions' => 0
            )
        );

        return $client;

    }

    private function Gutschein5EuroErzeigenUndAlsPdfVersenden($key, $email) {

        $empfaenger = $email;
        $link = 'http://newsletter.woehrl.de/gutschein/index.php?q='.$key;

        $subject = "Ihr persönlicher 5Euro-Gutschein"; //subject
        $controllerName = 'Newsletter';

        $htmlTemplate =  $this->getTemplateHtml($controllerName, 'GutscheinMail',
            $optMarkers= array(
                'GutscheinLink' =>$link,
            )
        );

        $Name = 'WÖHRL - Mode und Sport mit starken Marken';

        $header .= "Content-type: text/html; charset=ISO-8859-1\r\n";
        $header .= "From: ". utf8_decode($Name) . " <newsletter@woehrl.de>\n";
        //$header .= "Bcc: alexander.fuchs@woehrl.de"."\r\n";
        $header .= "Reply-To: <newsletter@woehrl.de>\n";

        $kopf = "From: " . mb_encode_mimeheader (mb_convert_encoding($Name ,"ISO-8859-1","AUTO")) . " <newsletter@woehrl.de>\n";
        $kopf .= "MIME-Version: 1.0\n";
        $kopf .=  "Content-type: text/html; charset=UTF-8\r\n";

        return mail($empfaenger , utf8_decode($subject) , utf8_decode($htmlTemplate) ,  $header);
        // E-Mail versenden
    }




    /**
     * A special action which is called if the originally intended action could
     * not be called, for example if the arguments were not valid.
     *
     * The default implementation sets a flash message, request errors and forwards back
     * to the originating action. This is suitable for most actions dealing with form input.
     *
     * We clear the page cache by default on an error as well, as we need to make sure the
     * data is re-evaluated when the user changes something.
     *
     * @return string
     */

    /*
    protected function errorAction() {
        echo 'Error Action ';
        $this->clearCacheOnError();
        if ($this->configurationManager->isFeatureEnabled('rewrittenPropertyMapper')) {
            echo 'Rewritten Property Mapper';

            echo '<pre>';
            foreach ($this->arguments->getValidationResults()->getFlattenedErrors() as $propertyPath => $errors) {
                foreach ($errors as $error) {
                    $message .= 'Error for ' . $propertyPath . ': ' . $error->render() .
                        PHP_EOL;
                }
                echo 'Error: ' . $message;

            }
            echo '</pre>';

            $errorFlashMessage = $this->getErrorFlashMessage();
            if ($errorFlashMessage !== FALSE) {
                $errorFlashMessageObject = new \TYPO3\CMS\Core\Messaging\FlashMessage(
                    $errorFlashMessage,
                    '',
                    \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR
                );
                $this->controllerContext->getFlashMessageQueue()->enqueue($errorFlashMessageObject);
            }
            $referringRequest = $this->request->getReferringRequest();
            if ($referringRequest !== NULL) {
                $originalRequest = clone $this->request;
                $this->request->setOriginalRequest($originalRequest);
                $this->request->setOriginalRequestMappingResults($this->arguments->getValidationResults());
                $this->forward($referringRequest->getControllerActionName(), $referringRequest->getControllerName(), $referringRequest->getControllerExtensionName(), $referringRequest->getArguments());
            }


            $message = 'An error occurred while trying to call ' . get_class($this) . '->' . $this->actionMethodName . '().' . PHP_EOL;
            return $message;
        } else {
            // @deprecated since Extbase 1.4.0, will be removed two versions after Extbase 6.1
            $this->request->setErrors($this->argumentsMappingResults->getErrors());
            $errorFlashMessage = $this->getErrorFlashMessage();
            if ($errorFlashMessage !== FALSE) {
                $errorFlashMessageObject = new \TYPO3\CMS\Core\Messaging\FlashMessage(
                    $errorFlashMessage,
                    '',
                    \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR
                );
                $this->controllerContext->getFlashMessageQueue()->enqueue($errorFlashMessageObject);
            }
            $referrer = $this->request->getInternalArgument('__referrer');
            if ($referrer !== NULL) {
                $this->forward($referrer['actionName'], $referrer['controllerName'], $referrer['extensionName'], $this->request->getArguments());
            }
            $message = 'An error occurred while trying to call ' . get_class($this) . '->' . $this->actionMethodName . '().' . PHP_EOL;
            return $message;
        }
    }


*/

}