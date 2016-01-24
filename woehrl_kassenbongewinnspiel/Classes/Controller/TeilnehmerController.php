<?php
namespace WOEHRL\WoehrlKassenbongewinnspiel\Controller;

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
 * TeilnehmerController
 */
class TeilnehmerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {



	/**
	 * teilnehmerRepository
	 *
	 * @var \WOEHRL\WoehrlKassenbongewinnspiel\Domain\Repository\TeilnehmerRepository
	 * @inject
	 */
	protected $teilnehmerRepository = NULL;

	/**
	 * Deactivate errorFlashMessage
	 *
	 * @return bool|string
	 */
	public function getErrorFlashMessage() {
		return FALSE;
	}

	/**
	 * action list
	 *
	 * @param WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer
	 * @return void
	 */
	public function listAction() {
		$teilnehmers = $this->teilnehmerRepository->findAll();
		$this->view->assign('teilnehmers', $teilnehmers);
	}

	/**
	 * action show
	 *
	 * @param WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer
	 * @return void
	 */
	public function showAction(\WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer $teilnehmer) {
		$this->view->assign('teilnehmer', $teilnehmer);
	}

	/**
	 * action new
	 *
	 * @param \WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer $newTeilnehmer
	 * @ignorevalidation $newTeilnehmer
	 * @return void
	 */
	public function newAction(\WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer $newTeilnehmer = NULL) {
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($gewinnspiel, "gewinnspiel");
		$this->view->assign('newTeilnehmer', $newTeilnehmer);
	}

	/**
	 * action create
	 *
	 * @param \WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer $newTeilnehmer
	 * @return void
	 */
	public function createAction(\WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer $newTeilnehmer) {
		if ($newTeilnehmer->getEmail()) {
			$newTeilnehmer->setHidden(1);
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $newTeilnehmer, "newTeilnehmer");

			//$newTeilnehmer->setEmail(trim(strtolower($newTeilnehmer->getEmail())));
			$this->teilnehmerRepository->add($newTeilnehmer);
			$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
			$persistenceManager->persistAll();
			$uid = $newTeilnehmer->getUid();
			$link = $this->controllerContext->getUriBuilder()->reset()->setArguments(
				array(
					'tx_woehrlkassenbongewinnspiel_pi1[action]' => 'update',
					'tx_woehrlkassenbongewinnspiel_pi1[key]' => md5($uid),
					'tx_woehrlkassenbongewinnspiel_pi1[controller]' => 'Teilnehmer'
				)
			)->setTargetPageUid(
				$this->settings['list_detail_pid']
			)->setCreateAbsoluteUri(
				true
			)->buildFrontendUri();



			$htmlTemplate = $this->getTemplateHtml('Teilnehmer', 'Email',
				$optMarkers = array(
					'EmpfaengerEmail' => $newTeilnehmer->getEmail(),
					'BestaetigungLink' => $link,
                    'Filiale' => abs($newTeilnehmer->getFiliale()),
                    'Kasse' => abs($newTeilnehmer->getKasse()),
                    'Bon' => abs($newTeilnehmer->getBon()),
                    'BonDatum' => $newTeilnehmer->getBondatum(),
					'Anrede' => $newTeilnehmer->getGender(),
					'Vorname' => ucwords($newTeilnehmer->getFirstname()),
					'Nachname' => ucwords($newTeilnehmer->getLastname()),
					'PLZ' => ucwords($newTeilnehmer->getZip()),
					'Address' => ucwords($newTeilnehmer->getAddress()),
					'Wohnort' => ucwords($newTeilnehmer->getCity()),
					'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
					'DATEMAIL' => time()
				)
			);

			$subject = 'Anmeldung WÖHRL Kassenbon - Gewinnspiel';
			$this->sendMail('Teilnehmer', $newTeilnehmer->getEmail(), $htmlTemplate, $subject);
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($uid, $uid);
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($htmlTemplate, 'htmlTemplate');
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($newTeilnehmende, 'newTeilnehmende');
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($link, 'link');
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($email, 'E-Mail-Addresse');
			$this->addFlashMessage(
				'Wir haben Ihnen eine E-Mail mit einem Bestätigungslink gesendet.
Bitte bestätigen Sie Ihre Teilnahme am WÖHRL Kassenbon - Gewinnspiel mit einem Klick auf den per E-Mail zugesendeten Link.<br /><br />Wir wünschen Ihnen viel Glück!<br /><br />
Ihr WÖHRL Gewinnspiel Team',
				'Vielen Dank!',
				\TYPO3\CMS\Core\Messaging\FlashMessage::OK,
				TRUE
			);
			$this->redirect('new', 'Teilnehmer');
		}
	}

	/**
	 * action edit
	 *
	 * @param WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer
	 * @ignorevalidation $teilnehmer
	 * @return void
	 */
	public function editAction(\WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer $teilnehmer) {
		$this->view->assign('teilnehmer', $teilnehmer);
	}

	/**
	 * action update
	 *
	 * @param WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer
	 * @return void
	 */
	public function updateAction(\WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer $teilnehmer = NULL) {
		//$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		if ($this->request->hasArgument('key')) {
			$args = $this->request->getArguments();
			$newTeilnehmer = $this->teilnehmerRepository->getTeilnehmendeNachMd5Uid($args['key']);
			//$newTeilnehmende = $this->teilnehmendeRepository->findByUid($newTeilnehmende->getUid())->setHidden(0);
			$newTeilnehmer->setHidden(0);
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($newTeilnehmer, 'newTeilnehmer');
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($args['key'], 'res');
			$res = $this->teilnehmerRepository->update($newTeilnehmer);
		}
		$this->addFlashMessage(
			'Wir wünschen Ihn viel Glück und freuen uns Sie schon bald wieder auf <br /> <a href ="http://www.woehrl.de">www.woehrl.de </a>begrüßen zu dürfen!<br /><br />
Ihr WÖHRL Gewinnspiel Team',
			'Vielen Dank für Ihre Teilnahme am WÖHRL Gewinnspiel!',
			\TYPO3\CMS\Core\Messaging\FlashMessage::OK,
			TRUE
		);
		$this->redirect('list', 'Teilnehmer');
	}

	/**
	 * action delete
	 *
	 * @param WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer
	 * @return void
	 */
	public function deleteAction(\WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer $teilnehmer) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->teilnehmerRepository->remove($teilnehmer);
		$this->redirect('list');
	}

	/**
	 * @param $controllerName
	 * @param $templateName
	 * @param $variables
	 */
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

	/**
	 * @param $uid
	 * @param $mailto
	 * @param $mailtemplateFile
	 * @param $subject
	 */
	private function sendMail($uid, $mailto, $mailtemplateFile, $subject) {
		$Name = 'WOEHRL - Mode & Sport mit starken Marken';
		//senders name
		$email = 'info@woehrl.de';
		//senders e-mail adress
		//$mailto = "alexander.fuchs@woehrl.de";
		$recipient = $mailto;
		//recipient
		$mail_body = $mailtemplateFile;
		$header = 'MIME-Version: 1.0
';
		$header .= 'Content-type: text/html; charset=ISO-8859-1
';
		$header .= 'From: ' . utf8_decode($Name) . ' <' . $email . '>
';
		//$header .= "Bcc: alexander.fuchs@woehrl.de"."\r\n";
		$header .= "Reply-To: {$email}\r\n";
		return mail($recipient, utf8_decode($subject), utf8_decode($mail_body), $header);
	}

}