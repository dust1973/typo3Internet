<?php
namespace WOEHRL\WoehrlGewinnspiele\Controller;


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
 * GewinnspielController
 */
class GewinnspielController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {


    /**
     * teilnehmerRepository
     *
     * @var \WOEHRL\WoehrlGewinnspiele\Domain\Repository\TeilnehmerRepository
     * @inject
     */
    protected $teilnehmerRepository = NULL;



    /**
	 * gewinnspielRepository
	 *
	 * @var \WOEHRL\WoehrlGewinnspiele\Domain\Repository\GewinnspielRepository
	 * @inject
	 */
	protected $gewinnspielRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$gewinnspiels = $this->gewinnspielRepository->findAll();
		$this->view->assign('gewinnspiels', $gewinnspiels);
	}

	/**
	 * action show
	 *
	 * @param \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $gewinnspiel
	 * @return void
	 */
	public function showAction(\WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $gewinnspiel) {
		$this->view->assign('gewinnspiel', $gewinnspiel);
	}

	/**
	 * action new
	 *
	 * @param \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $newGewinnspiel
	 * @ignorevalidation $newGewinnspiel
	 * @return void
	 */
	public function newAction(\WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $newGewinnspiel = NULL) {
		$this->view->assign('newGewinnspiel', $newGewinnspiel);
	}

	/**
	 * action create
	 *
	 * @param \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $newGewinnspiel
	 * @return void
	 */
	public function createAction(\WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $newGewinnspiel) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->gewinnspielRepository->add($newGewinnspiel);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $gewinnspiel
	 * @ignorevalidation $gewinnspiel
	 * @return void
	 */
	public function editAction(\WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $gewinnspiel) {
		$this->view->assign('gewinnspiel', $gewinnspiel);
	}

	/**
	 * action update
	 *
	 * @param \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $gewinnspiel
	 * @return void
	 */
	public function updateAction(\WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $gewinnspiel) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->gewinnspielRepository->update($gewinnspiel);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $gewinnspiel
	 * @return void
	 */
	public function deleteAction(\WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel $gewinnspiel) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->gewinnspielRepository->remove($gewinnspiel);
		$this->redirect('list');
	}



}