<?php
namespace WOEHRL\WoehrlStylecardantrag\Controller;

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
 * StylecardantragController
 */

require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_stylecardantrag') . '/Classes/Barcode/BCGColor.php';
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_stylecardantrag') . '/Classes/Barcode/BCGBarcode.php';
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_stylecardantrag') . '/Classes/Barcode/BCGDrawing.php';
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_stylecardantrag') . '/Classes/Barcode/BCGFontFile.php';
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_stylecardantrag') . '/Classes/Barcode/BCGcode128.php';

class StylecardantragController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * stylecardantragRepository
     *
     * @var \WOEHRL\WoehrlStylecardantrag\Domain\Repository\StylecardantragRepository
     * @inject
     */
    protected $stylecardantragRepository = NULL;

    /**
     * action form
     * @param \WOEHRL\WoehrlStylecardantrag\Domain\Model\Stylecardantrag $stylecardantrag
     * @return void
     */


    /* Deaktiviert FlashMessage für Fehler
 * @see Tx_Extbase_MVC_Controller_ActionController::getErrorFlashMessage()
 */
    protected function getErrorFlashMessage() {
        return FALSE;
    }

    public function formAction(\WOEHRL\WoehrlStylecardantrag\Domain\Model\Stylecardantrag $stylecardantrag = NULL)

    {

       // $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

 //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $stylecardantrag, 'result');
//die;
        if ($stylecardantrag) {

            if(empty($titel = $stylecardantrag->getTitel())){
                $stylecardantrag->setTitel('0');
            }

           /* $data = array(
                $gender = $stylecardantrag->getAnrede(),
                $stylecardantrag->getTitel(),
                $first_name = ucwords($stylecardantrag->getVorname()),
                $last_name = ucwords($stylecardantrag->getNachname()),
                $address = ucwords($stylecardantrag->getAdresse()),
                $phone = $stylecardantrag->getTelefon(),
                $mobile = $stylecardantrag->getMobil(),
                $zip = $stylecardantrag->getPlz(),
                $city = ucwords($stylecardantrag->getOrt()),
                $birthday = $stylecardantrag->getGeburtsdatum(),
                $email = $stylecardantrag->getEmail(),
                $country = $stylecardantrag->getLand(),
                $description = 'new.woehrl.de',
                $Werbung = $stylecardantrag->isAgb()

            );
           */
           /* $birthday = strtotime($stylecardantrag->getGeburtsdatum());
            $Minus18jahre = (strtotime('-18 Year'));
            if($birthday < $Minus18jahre){

                \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( 'Fehler: Teilnahmeberechtigt sind Personen ab 18 Jahren'  , 'birthday');
            }


                \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $Minus18jahre , 'Minus18jahre');


*/



                        $result = $this->getWSDL()->kundendatenAnlegen(
                            $gender = $stylecardantrag->getAnrede(),
                            $stylecardantrag->getTitel(),
                            $first_name = ucwords($stylecardantrag->getVorname()),
                            $last_name = ucwords($stylecardantrag->getNachname()),
                            $address = ucwords($stylecardantrag->getAdresse()),
                            $phone = $stylecardantrag->getTelefon(),
                            $mobile = $stylecardantrag->getMobil(),
                            $zip = $stylecardantrag->getPlz(),
                            $city = ucwords($stylecardantrag->getOrt()),
                            $stylecardantrag->getGeburtsdatum(),
                            $email = $stylecardantrag->getEmail(),
                            $country = $stylecardantrag->getLand(),
                            $description = 'new.woehrl.de',
                            $Werbung = $stylecardantrag->isWerbung()

                        );

                if($result){

                        $Identifikationsnummer = $result->item[0]->value;
                        $email = $result->item[2]->value;
                        $Aktion = $result->item[4]->value;

                        $link = $this
                            ->controllerContext
                            ->getUriBuilder()
                            ->reset()
                            ->setArguments(array(
                                'tx_woehrlstylecardantrag_pi1[action]' => 'subscribe',
                                'tx_woehrlstylecardantrag_pi1[key]' => $Identifikationsnummer)
                            )
                            ->setTargetPageUid($this->settings['list_detail_pid'])
                            ->setCreateAbsoluteUri(true)
                            ->buildFrontendUri();

                        $subject = "Bestätigung Ihrer stylecard-Anmeldung"; //subject

                    $controllerName = 'Stylecardantrag';

                  $htmlTemplate =  $this->getTemplateHtml($controllerName, 'Email',
                      $optMarkers= array(
                      'EmpfaengerEmail' =>$email,
                      'BestaetigungLink' =>$link,
                      'Anrede' =>$gender,
                          'Nachname' =>$last_name,
                      )
                  );
                        switch ($Aktion) {
                            case 'Kunde bereits aktiviert':
                                //--Kunde bereits aktiviert
                               // "Fehler: Es ist bereits ein Benutzer mit der E-Mail-Adresse ".$result->item[2]->value." angemeldet!"

                                $this->addFlashMessage(
                                    $messageBody = "<div class='alert alert-danger' role='alert'>Fehler: Es ist bereits ein Benutzer mit der E-Mail-Adresse <b>".$result->item[2]->value."</b> angemeldet!</div>",
                                    $messageTitle = "",
                                    $severity = \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
                                    $storeInSession = FALSE
                                );
                                break;
                            case 'Nicht aktivierter Kunde':

                              if($this->sendMail($Identifikationsnummer, $email, $htmlTemplate, '', '', '', $subject)){
                                  $stylecardantrag->setMeldung('2');

                                }

                                if($stylecardantrag->getEmail()=='alexander.fuchs@woehrl.de'){
                                    $Identifikationsnummer = $result->item[0]->value;
                                    $res = $this->getWSDL()->StylecardAntragAktivieren($Identifikationsnummer);
                                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $result, 'result');
                                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $stylecardantrag, 'stylecardantrag');
                                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $res, 'res');
                                    die;
                                }

                                break;

                            case 'Neukunde':
                                if($this->sendMail($Identifikationsnummer, $email, $htmlTemplate, '', '', '', $subject)){
                                    $stylecardantrag->setMeldung('2');
                                }
                                if($stylecardantrag->getEmail()=='alexander.fuchs@woehrl.de'){
                                    $Identifikationsnummer = $result->item[0]->value;
                                    $res = $this->getWSDL()->StylecardAntragAktivieren($Identifikationsnummer);
                                    $daten = $this->getWSDL()->GetStylecardInfos($Identifikationsnummer);
                                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $result, 'result');
                                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $stylecardantrag, 'stylecardantrag');
                                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $res, 'res');
                                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $daten, 'daten');
                                    die;
                                }
                                break;

                            default:
                                $stylecardantrag->setMeldung('default');
                        }
                }

        }

        $this->view->assign('stylecardantrag', $stylecardantrag);
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
            $result = $this->getWSDL()->StylecardAntragAktivieren($key);

             //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $result->Ergebnis, 'result');

            switch ($result->Ergebnis) {
                case 'Erfolgreich aktiviert':

                    $daten = $this->getWSDL()->GetStylecardInfos($key);
                    $mailto = $daten->email;
                    $gender = $daten->gender;
                    $gender==1 ? $gender = 'Herr': $gender = 'Frau';
                    $nachname = $daten->last_name;
                    $vorname = $daten->first_name;
                    $kdnr = $daten->KDNR;
                    $Werbung = $daten->Werbung;
                    $bildurl = $this->code128($kdnr, $vorname, $nachname, $gender);


                    if($Werbung==1){

                        $GutscheinaktionIdentifikation = 'D735B632-B38C-E311-AAF1-003048CEE820';

                        /***********************************************************************/
                        /***********************************************************************/

                        $code = $this->getWSDL()->Gutscheinerzeugung($key, $GutscheinaktionIdentifikation);

                        /***********************************************************************/
                        /***********************************************************************/

                        if ($code->ErrorID) {
                            switch ($code->ErrorID) {
                                case '-2' :
                                    //-2 Gutschein wurde bereits fuer den Kunden ausgestellt
                                    // ( Gutschein fuer KundeUid und Gutscheinaktion bereits vorhanden)
                                    break;

                                case '-1' :
                                    //-1 Kunde oder Gutscheinaktion nicht definiert
                                    break;

                                default :
                            }

                        }elseif($code->Gutscheinbarcode){
                            $this->Gutschein5EuroErzeigenUndAlsPdfVersenden($key, $mailto);
                            //5 Euro Gutschein erzeigen und versenden
                        }

                    }



                    $htmlTemplate =  $this->getTemplateHtml('Stylecardantrag', 'StyleCardMail',
                        $optMarkers= array(
                            'EmpfaengerEmail' =>$mailto,
                            'Nachname' =>$nachname,
                            'Bildurl' =>$bildurl,
                            'Anrede' =>$gender,
                        )
                    );
                    $subject = "Ihre vorläufige WÖHRL stylecard"; //subject

                    if($this->sendMail($key, $mailto, $htmlTemplate, $gender, $nachname, $bildurl,$subject)){
                        $error = 2;
                        break;
                    }else{
                        $error = 3;
                        break;
                    }

                case 'Fehler':
                    //--Kunde in Tabelle nicht vorhanden.
                    $error = 4;
                    break;

                case 'Bereits aktiviert':
                    //--Kunde bereits aktiviert
                    $error = 5;
                    break;

                default:
                    $error = 6;
                    break;
            }

            $this->view->assign('content', $error);
        }
    }


    private function sendMail($uid , $mailto , $mailtemplateFile, $gender , $nachname , $bildurl, $subject)
    {
        $Name = "WÖHRL - Mode & Sport mit starken Marken"; //senders name
        $email = "stylecard@woehrl.de"; //senders e-mail adress
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
            //$font = new BCGFontFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_stylecardantrag') . '/Classes/Barcode/Font'. $f1, intval($f2));
            $font = new \BCGFontFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_stylecardantrag') . 'Classes/Barcode/Font/'. $f1, intval($f2));
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
            $drawing = new \BCGDrawing('./uploads/tx_woehrlstylecardantrag/' . $kdnr . '.png', $color_white);

            if ($drawException) {
                $drawing->drawException($drawException);
            } else {

                $drawing->setBarcode($code_generated);
                $drawing->setRotationAngle('0');
                $drawing->setDPI('72');
                $drawing->draw();
            }
            $drawing->finish(intval($oo));

            $image1 = imageCreateFromjpeg("./typo3conf/ext/woehrl_stylecardantrag/Resources/Public/Images/Woehrl-stylecard-Kundenkarte.jpg");
            $image2 = imageCreateFromPNG('./uploads/tx_woehrlstylecardantrag/' . $kdnr . '.png');

            imageCopy($image1, $image2,
                28, 125,
                0, 0,
                123, 62);
            $color = ImageColorAllocate($image1, 255, 255, 255);
           $font_file =  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('woehrl_stylecardantrag') . '/Classes/Barcode/Font/Arial.ttf';
            if (strlen($vorname . ' ' . $nachname) < 24) {
                imagefttext($image1, 11, 0, 25, 70, $color, $font_file, $gender);
                imagefttext($image1, 11, 0, 25, 90, $color, $font_file, $vorname . ' ' . $nachname);
            } else {
                imagefttext($image1, 11, 0, 25, 70, $color, $font_file, $gender);
                imagefttext($image1, 11, 0, 25, 90, $color, $font_file, $nachname);
            }
            imagefttext($image1, 11, 0, 25, 110, $color, $font_file, $kdnr);
            if (imagejpeg($image1, './uploads/tx_woehrlstylecardantrag/stylecard_' . $kdnr . '.jpg', 100)) {
                return './uploads/tx_woehrlstylecardantrag/stylecard_' . $kdnr . '.jpg';

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

        $wsdl = 'https://websvc-custdata.woehrl.de/stylecardantrag.wsdl';
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
        $controllerName = 'Stylecardantrag';

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
    public function time_elapsed_A($secs){
        $bit = array(
            'y' => $secs / 31556926 % 12,
            'w' => $secs / 604800 % 52,
            'd' => $secs / 86400 % 7,
            'h' => $secs / 3600 % 24,
            'm' => $secs / 60 % 60,
            's' => $secs % 60
        );

        foreach($bit as $k => $v)
            if($v > 0)$ret[] = $v . $k;

        return join(' ', $ret);
    }


    public function time_elapsed_B($secs){
        $bit = array(
            ' year'        => $secs / 31556926 % 12,
            ' week'        => $secs / 604800 % 52,
            ' day'        => $secs / 86400 % 7,
            ' hour'        => $secs / 3600 % 24,
            ' minute'    => $secs / 60 % 60,
            ' second'    => $secs % 60
        );

        foreach($bit as $k => $v){
            if($v > 1)$ret[] = $v . $k . 's';
            if($v == 1)$ret[] = $v . $k;
        }
        array_splice($ret, count($ret)-1, 0, 'and');
        $ret[] = 'ago.';

        return join(' ', $ret);
    }

}