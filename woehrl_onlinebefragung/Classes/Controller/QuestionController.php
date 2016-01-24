<?php
namespace WOEHRL\WoehrlOnlinebefragung\Controller;

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
use WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation;

/**
 * QuestionController
 */
class QuestionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * questionRepository
     *
     * @var \WOEHRL\WoehrlOnlinebefragung\Domain\Repository\QuestionRepository
     * @inject
     */
    protected $questionRepository = NULL;



    /**
     * relationRepository
     *
     * @var \WOEHRL\WoehrlOnlinebefragung\Domain\Repository\RelationRepository
     * @inject
     */
    protected $relationRepository = NULL;


    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {

        $pid = $GLOBALS['TSFE']->id;
        $categoryId = $this->settings['category'];
        $arg = $this->request->getArguments();


        if ($arg['submit']) {
            $questions = $this->questionRepository->findByUid($arg['question']);
            $req = $arg['answer'];



            $error = array();
            if (is_array($req)) {

                //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($questions->isRequirefeld(), "isRequirefeld");
                foreach ($req as $re => $key) {//$key is answerX POST value
                    if ($key == 0) {
                        $error[] = $req;
                    }
                }
                if ((count($error) > 1) AND ($questions->isRequirefeld())) {
                    $error = true;
                    $header = 'Bitte antworten Sie korrekt auf alle gestellten Fragen!';
                } else {
                    $error = false;
                }
            } elseif (($req == NULL) AND ($questions->isRequirefeld())) {
                $error = true;
                $header = 'Sie müssen mindestens 1 Antwort wählen!.';
            } else {

            }

            if ($error) {
                $message = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                    $header,
                    'Fehler!', // the header is optional
                    \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR, // the severity is optional as well and defaults to \TYPO3\CMS\Core\Messaging\FlashMessage::OK
                    TRUE // optional, whether the message should be stored in the session or only in the \TYPO3\CMS\Core\Messaging\FlashMessageQueue object (default is FALSE)
                );
                \TYPO3\CMS\Core\Messaging\FlashMessageQueue::addMessage($message);
                $question = $this->questionRepository->findByUid($arg['question']);
                $this->view->assign('question', $question);
            } else {

                $method = 'GetNextquestion' . $arg['answer'];

                switch ($questions->GetTyp()) {
                    case 0: //Multiple answers possible (check-box)
                        $nextquestionID = $questions->GetNextquestion1();
                        break;
                    case 1://Choose one answer (radio-button)
                        $nextquestionID = $questions->$method();
                        break;
                    case 2: //elect one answer (select-box)
                        $nextquestionID = $questions->$method();
                        break;
                    case 3://Enter an answer (text-field)
                        $nextquestionID = $questions->GetNextquestion1();
                        break;
                    case 4://Yes/no-boxes (2 radio-buttons)
                        $nextquestionID = $questions->$method();
                        break;
                    case 5://Enter a comment (textarea)
                        $nextquestionID = $questions->GetNextquestion1();
                        break;
                    case 6://Abschlüsstext
                        $nextquestionID = $questions->$method();
                        break;
                    case 7://Star rating
                        //$nextquestionID = $questions->GetNextquestion1();
                        $answer = $arg['answer'][0];
                        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($answer, '$answer');
                        if ($answer <= $questions->GetAnswer1()) {
                            $nextquestionID = $questions->GetNextquestion1();
                        } else {
                            $nextquestionID = $questions->GetNextquestion2();
                        }
                        break;
                    default:
                        $nextquestionID = $questions->$method();
                }
                if ($arg['uid']) {
                    $sessionData = $this->restoreFromSession($arg['uid']);
                    $sessionData = (array)$sessionData;

                    $sessionData['antwort'][$arg['question']] = $req;
                    $this->writeToSession($sessionData, $arg['uid']);
                    $this->view->assign('uid', $arg['uid']);

                    if($sessionData['kunde']->email){
                    $this->view->assign('email', $sessionData['kunde']->email);
                    }
                }else{
                    $uid = $GLOBALS["TSFE"]->fe_user->id;
                    $sessionData = $this->restoreFromSession($uid);
                }


                $question = $this->questionRepository->findByUid($nextquestionID);

                if ($question->getTyp() == 6) {
                    $ret = $this->restoreFromSession($arg['uid']);
                    /*\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($ret, "session");
                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($req, "answer");
                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($question->getTyp(), "questions");*/

                    /********************************************************************************/
                    /*\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('E-Mail-Versand in Bearbeitung');
                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($arg['werbung'], 'werbung');
                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($arg['email'], 'E-mail');*/

                    //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($ret['kunde'], 'gender');
                    //die;


                    if ($ret['kunde']->first_name) {
                        $vorname = $ret['kunde']->first_name;
                    } else {
                        $vorname = '';
                    }
                    if ($ret['kunde']->last_name) {
                        $nachname = $ret['kunde']->last_name;
                    } else {
                        $nachname = '';
                    }

                    if ($ret['kunde']->gender == 1) {
                        $gender = 'Sehr geehrter Herr ';
                    } elseif ($ret['kunde']->gender == 2) {
                        $gender = 'Sehr geehrte Frau ';
                    } else {
                        $gender = 'Liebe WÖHRL Kundin, lieber WÖHRL Kunde ';
                        $nachname = '';
                        $vorname = '';
                    }

                    $subject = "Danke für Ihre Teilnahme!"; //subject
                    $controllerName = 'Question';
                    //$gender = $Newsletter->getAnrede();

                    //if($pid == 202){
//
  //                      \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($arg, 'arg');
    //                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($ret, 'ret');
      //              }
                    /********************************************************************************/
                    if ($arg['uid'] AND $ret['kunde']->email) {
                        $htmlTemplate = $this->getTemplateHtml($controllerName, 'Email5',
                            $optMarkers = array(
                                'EmpfaengerEmail' => $arg['email'],
                                'BestaetigungLink' => $link = '',
                                'Anrede' => $gender,
                                'Vorname' => ucwords($vorname),
                                'Nachname' => ucwords($nachname),
                                'Email' => $ret['kunde']->email,
                            )
                        );
                        $email =  $ret['kunde']->email;
                        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $htmlTemplate, 'arg');
                        foreach($sessionData['antwort'] as $antwort =>$key){
                            $relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation;
                            $relation->setUseremail($email);

                            if(is_array($key)){
                                $relation->setAnswer1($key[0]);
                                $relation->setAnswer2($key[1]);
                                $relation->setAnswer3($key[2]);
                                $relation->setAnswer4($key[3]);
                                $relation->setAnswer4($key[4]);
                            }else{
                                $relation->setAnswer1($key);
                                $relation->setAnswer2('');
                                $relation->setAnswer3('');
                                $relation->setAnswer4('');
                                $relation->setAnswer4('');
                            }

                            $relation->setFrage($antwort);

                            $relation->setUserid($arg['uid']);

                           // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($sessionData, 'sessionData');
                            //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($relation, 'relation');

                            $ret = $this->relationRepository->add($relation);
                            //$events = $this->eventRepository->findDemanded($demand, $limit);
                            //$this->debugQuery($ret);

                            # Den Vorschlaghammer instanzieren / aus der Kiste kramen
                            $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");

                            # Mit dem Vorschlaghammer in die Datenbank speichern / Nägel mit Köpfen machen
                            $persistenceManager->persistAll();

                        }


                        $this->sendMail($email, $htmlTemplate, $subject);
                    }
					if($pid==193){
					//$this->view->setTemplatePathAndFilename('typo3conf/ext/woehrl_onlinebefragung/Resources/Private/Templates/Question/Abschluesstext.html');
					}else{
                    $this->view->setTemplatePathAndFilename('typo3conf/ext/woehrl_onlinebefragung/Resources/Private/Templates/Question/Gesendet.html');
					}
                    /********************************************************************************/

                }

                $this->view->assign('question', $question);
            }

        } else {
            if ($arg['uid']) {
                if ($kdaten = $this->getWSDL()->getEMailByUidHash($arg['uid'])) {
                    $sessionData['kunde'] = $kdaten;
                    $this->writeToSession($sessionData, $arg['uid']);
                    $this->view->assign('uid', $arg['uid']);
                }
            }else{
                $uid = $GLOBALS["TSFE"]->fe_user->id;
                $kdaten = array('lastname' =>'anonymous');
                $sessionData['kunde'] = $kdaten;
                $this->writeToSession($sessionData, $uid);
                $this->view->assign('uid',  $uid);
            }


            $questions = $this->questionRepository->findByKat($categoryId, $pid);

            foreach ($questions as $question) {
                $this->view->assign('question', $question);
            }

        }
    }

    /**
     * action show
     * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation
     * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $question
     * @return void
     */
    public function showAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $question)
    {
        $arg = $this->request->getArguments();
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($arg, 'ID');

        $error = array();
        if ($arg['email'] == '') {
            $error = true;
            $header = 'Bitte eine gültige E-Mail-Adresse eingeben!';
        }
        if ($error) {

            $message = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                $header,
                'Fehler!', // the header is optional
                \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR, // the severity is optional as well and defaults to \TYPO3\CMS\Core\Messaging\FlashMessage::OK
                TRUE // optional, whether the message should be stored in the session or only in the \TYPO3\CMS\Core\Messaging\FlashMessageQueue object (default is FALSE)
            );
            \TYPO3\CMS\Core\Messaging\FlashMessageQueue::addMessage($message);
            $question = $this->questionRepository->findByUid($arg['question']);
            $this->view->assign('question', $question);
        }else{

       // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('E-Mail-Versand in Bearbeitung');
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($arg['werbung'], 'werbung');
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($arg['email'], 'E-mail');

        $subject = "Danke für Ihre Teilnahme!"; //subject
        $controllerName = 'Question';
        $gender = '';
        if ($arg['werbung']) {
            $kindermode = 0;
            $herrenmode = 0;
            $damenmode = 0;

            $result = $this->getWSDL()->emailAnlegen(
                '',
                '',
                $arg['email'],
                '',
                '',
                $bestand = 'Kundenumfrage',
                '',
                '',
                $kindermode,
                $herrenmode,
                $damenmode
            );

            if (strlen($result) == 36) {
                $link = $this
                    ->controllerContext
                    ->getUriBuilder()
                    ->reset()
                    ->setArguments(array(
                            'tx_woehrlnewsletter_pi1[action]' => 'subscribe',
                            'tx_woehrlnewsletter_pi1[key]' => $result)
                    )
                    ->setTargetPageUid(88)
                    ->setCreateAbsoluteUri(true)
                    ->buildFrontendUri();
                $templatename = 'EmailOptIn';
            } else {
                $templatename = 'Email';
            }
        } else {
            $templatename = 'Email';
        }
        $htmlTemplate = $this->getTemplateHtml($controllerName, $templatename,
            $optMarkers = array(
                'EmpfaengerEmail' => $arg['email'],
                'BestaetigungLink' => $link,
                'Anrede' => $gender,
                'Vorname' => ucwords(''),
                'Nachname' => ucwords(''),
            )
        );

        $uid = $GLOBALS["TSFE"]->fe_user->id;
        $sessionData = $this->restoreFromSession($uid);
        $sessionData = (array)$sessionData;
        if($arg['email']) {
            $sessionData['kunde']['email'] = $arg['email'];
        }else{
            $sessionData['kunde']['email'] = '" "';
        }
        $sessionData['kunde']['umfrage'] = true;

        $this->writeToSession($sessionData, $uid);
        $this->view->assign('uid',  $uid);
        $sessionData = $this->restoreFromSession($uid);



        foreach($sessionData['antwort'] as $antwort =>$key){
            $relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation;

            if(is_array($key)){
                $relation->setAnswer1($key[0]);
                $relation->setAnswer2($key[1]);
                $relation->setAnswer3($key[2]);
                $relation->setAnswer4($key[3]);
                $relation->setAnswer4($key[4]);
            }else{
                $relation->setAnswer1($key);
                $relation->setAnswer2('');
                $relation->setAnswer3('');
                $relation->setAnswer4('');
                $relation->setAnswer4('');
            }

            $relation->setFrage($antwort);
            $relation->setUseremail($sessionData['kunde']['email']);
            $relation->setUserid($uid);

            $ret = $this->relationRepository->add($relation);
            //$events = $this->eventRepository->findDemanded($demand, $limit);
            //$this->debugQuery($ret);

            # Den Vorschlaghammer instanzieren / aus der Kiste kramen
            $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");

            # Mit dem Vorschlaghammer in die Datenbank speichern / Nägel mit Köpfen machen
            $persistenceManager->persistAll();

        }
       // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($relation, 'relation');
            
        $this->sendMail($arg['email'], $htmlTemplate, $subject);
        $this->view->setTemplatePathAndFilename('typo3conf/ext/woehrl_onlinebefragung/Resources/Private/Templates/Question/Gesendet.html');
        }
        //$this->view->assign('question', $question);
    }

    /**
     * action new
     *
     * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $newQuestion
     * @ignorevalidation $newQuestion
     * @return void
     */
    public function newAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $newQuestion = NULL)
    {
        $this->view->assign('newQuestion', $newQuestion);
    }

    /**
     * action create
     *
     * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $newQuestion
     * @return void
     */
    public function createAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $newQuestion)
    {


        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->questionRepository->add($newQuestion);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $question
     * @ignorevalidation $question
     * @return void
     */
    public function editAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $question)
    {
        $this->view->assign('question', $question);
    }

    /**
     * action update
     *
     * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $question
     * @return void
     */
    public function updateAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $question)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->questionRepository->update($question);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $question
     * @return void
     */
    public function deleteAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question $question)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->questionRepository->remove($question);
        $this->redirect('list');
    }

    private function sendMail($mailto, $mailtemplateFile, $subject)
    {
        $Name = "WÖHRL Onlinebefragung"; //senders name
        $email = "newsletter@woehrl.de"; //senders e-mail adress
        //$mailto = "alexander.fuchs@woehrl.de";
        $recipient = $mailto; //recipient


        $mail_body = $mailtemplateFile;

        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=ISO-8859-1\r\n";
        $header .= "From: " . utf8_decode($Name) . " <" . $email . ">\r\n";
        //$header .= "Bcc: alexander.fuchs@woehrl.de"."\r\n";
        $header .= "Reply-To: $email\r\n";

        return mail($recipient, utf8_decode($subject), utf8_decode($mail_body), $header);

    }

    public function getTemplateHtml($controllerName, $templateName, $variables)
    {

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

    private function getWSDL()
    {

        $wsdl = 'https://websvc-custdata.woehrl.de/newsletter_mssql.wsdl';
        $client = new \SoapClient($wsdl,
            array(
                "trace" => 0,
                'exceptions' => 0
            )
        );

        return $client;

    }

    /**
     * Returns the object stored in the user´s PHP session
     * * @param    $object    any serializable object to store into the session
     * @return Object the stored object
     */
    public function restoreFromSession($id)
    {
        $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', $id);
        //return unserialize($sessionData);
        return $sessionData;
    }

    /**
     * Writes an object into the PHP session
     * @param    $object    any serializable object to store into the session
     * @return    Tx_MyExt_Domain_Session_SessionHandler this
     */
    public function writeToSession($object, $id)
    {
        //$sessionData = serialize($object);
        $sessionData = $object;
        $GLOBALS['TSFE']->fe_user->setKey('ses', $id, $sessionData);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
        return $this;
    }

    /**
     * Cleans up the session: removes the stored object from the PHP session
     * @return    Tx_MyExt_Domain_Session_SessionHandler this
     */
    public function cleanUpSession()
    {
        $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_woehrlonlinebefragung_pi1', NULL);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
        return $this;
    }


    /**
     * Debugs a SQL query from a QueryResult
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult
     * @param boolean $explainOutput
     * @return void
     */
    public function debugQuery(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult, $explainOutput = FALSE){
        $GLOBALS['TYPO3_DB']->debugOuput = 2;
        if($explainOutput){
            $GLOBALS['TYPO3_DB']->explainOutput = true;
        }
        $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
        $queryResult->toArray();
        DebuggerUtility::var_dump($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

        $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = false;
        $GLOBALS['TYPO3_DB']->explainOutput = false;
        $GLOBALS['TYPO3_DB']->debugOuput = false;
    }

}