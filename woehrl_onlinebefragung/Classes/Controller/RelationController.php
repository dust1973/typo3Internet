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

/**
 * RelationController
 */
class RelationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
	public function listAction() {
		$relations = $this->relationRepository->findAll();
		$this->view->assign('relations', $relations);
	}

	/**
	 * action show
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation
	 * @return void
	 */
	public function showAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation) {
		$this->view->assign('relation', $relation);
	}

	/**
	 * action new
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $newRelation
	 * @ignorevalidation $newRelation
	 * @return void
	 */
	public function newAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $newRelation = NULL) {
		$this->view->assign('newRelation', $newRelation);
	}

	/**
	 * action create
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $newRelation
	 * @return void
	 */
	public function createAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $newRelation) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->relationRepository->add($newRelation);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation
	 * @ignorevalidation $relation
	 * @return void
	 */
	public function editAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation) {
		$this->view->assign('relation', $relation);
	}

	/**
	 * action update
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation
	 * @return void
	 */
	public function updateAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->relationRepository->update($relation);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation
	 * @return void
	 */
	public function deleteAction(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->relationRepository->remove($relation);
		$this->redirect('list');
	}

}