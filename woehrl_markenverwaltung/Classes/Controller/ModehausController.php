<?php
namespace Woehrl\WoehrlMarkenverwaltung\Controller;

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
 * ModehausController
 */
class ModehausController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * modehausRepository
	 *
	 * @var \Woehrl\WoehrlMarkenverwaltung\Domain\Repository\ModehausRepository
	 * @inject
	 */
	protected $modehausRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$modehauses = $this->modehausRepository->findAll();
		$this->view->assign('modehauses', $modehauses);
	}

	/**
	 * action show
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $modehaus
	 * @return void
	 */
	public function showAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $modehaus) {
		$this->view->assign('modehaus', $modehaus);
	}

	/**
	 * action new
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $newModehaus
	 * @ignorevalidation $newModehaus
	 * @return void
	 */
	public function newAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $newModehaus = NULL) {
		$this->view->assign('newModehaus', $newModehaus);
	}

	/**
	 * action create
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $newModehaus
	 * @return void
	 */
	public function createAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $newModehaus) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->modehausRepository->add($newModehaus);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $modehaus
	 * @ignorevalidation $modehaus
	 * @return void
	 */
	public function editAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $modehaus) {
		$this->view->assign('modehaus', $modehaus);
	}

	/**
	 * action update
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $modehaus
	 * @return void
	 */
	public function updateAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $modehaus) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->modehausRepository->update($modehaus);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $modehaus
	 * @return void
	 */
	public function deleteAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus $modehaus) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->modehausRepository->remove($modehaus);
		$this->redirect('list');
	}

}