<?php
namespace WOEHRL\Umfrage\Controller;

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
 * ErgebnisController
 */
class ErgebnisController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * ergebnisRepository
	 *
	 * @var \WOEHRL\WoehrlOnlinebefragung\Domain\Repository\RelationRepository
	 * @inject
	 */
	protected $ergebnisRepository;

	/**
	 * @return void
	 */
	public function initializeAction() {



			$configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\BackendConfigurationManager');
			$this->settings = $configurationManager->getConfiguration(
				$this->request->getControllerExtensionName(),
				$this->request->getPluginName()
			);

		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($configurationManager, '$this->id');

	}

	/**
	 * injectErgebnisRepository
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Repository\RelationRepository $ergebnisRepository
	 * @return void
	 */
	public function injectErgebnisRepositoryRepository(\WOEHRL\WoehrlOnlinebefragung\Domain\Repository\RelationRepository $ergebnisRepository) {
		$this->ergebnisRepository = $ergebnisRepository;
	}



	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$ergebnis = $this->ergebnisRepository->findAll();
		//$this->debugQuery($ergebnis);
		# Den Vorschlaghammer instanzieren / aus der Kiste kramen
		$persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");

		# Mit dem Vorschlaghammer in die Datenbank speichern / Nägel mit Köpfen machen
		$persistenceManager->persistAll();

		$Antworten = array();
		foreach ($ergebnis as $antwort){


			$Antworten[$antwort->Getfrage()][] = $antwort;

		}

		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($Antworten, 'sessionData');



		$this->view->assign('antworten', $Antworten);
	}

	/**
	 * action show
	 *
	 * @param WOEHRL\Umfrage\Domain\Model\Ergebnis $ergebnis
	 * @return void
	 */
	public function showAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Ergebnis $ergebnis) {
		$this->view->assign('ergebnis', $ergebnis);
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
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = false;
		$GLOBALS['TYPO3_DB']->explainOutput = false;
		$GLOBALS['TYPO3_DB']->debugOuput = false;
	}




}