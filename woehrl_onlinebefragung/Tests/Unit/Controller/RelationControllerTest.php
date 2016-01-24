<?php
namespace WOEHRL\WoehrlOnlinebefragung\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class WOEHRL\WoehrlOnlinebefragung\Controller\RelationController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class RelationControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \WOEHRL\WoehrlOnlinebefragung\Controller\RelationController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Controller\\RelationController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllRelationsFromRepositoryAndAssignsThemToView() {

		$allRelations = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$relationRepository = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Domain\\Repository\\RelationRepository', array('findAll'), array(), '', FALSE);
		$relationRepository->expects($this->once())->method('findAll')->will($this->returnValue($allRelations));
		$this->inject($this->subject, 'relationRepository', $relationRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('relations', $allRelations);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenRelationToView() {
		$relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('relation', $relation);

		$this->subject->showAction($relation);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenRelationToView() {
		$relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newRelation', $relation);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($relation);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenRelationToRelationRepository() {
		$relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation();

		$relationRepository = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Domain\\Repository\\RelationRepository', array('add'), array(), '', FALSE);
		$relationRepository->expects($this->once())->method('add')->with($relation);
		$this->inject($this->subject, 'relationRepository', $relationRepository);

		$this->subject->createAction($relation);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenRelationToView() {
		$relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('relation', $relation);

		$this->subject->editAction($relation);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenRelationInRelationRepository() {
		$relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation();

		$relationRepository = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Domain\\Repository\\RelationRepository', array('update'), array(), '', FALSE);
		$relationRepository->expects($this->once())->method('update')->with($relation);
		$this->inject($this->subject, 'relationRepository', $relationRepository);

		$this->subject->updateAction($relation);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenRelationFromRelationRepository() {
		$relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation();

		$relationRepository = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Domain\\Repository\\RelationRepository', array('remove'), array(), '', FALSE);
		$relationRepository->expects($this->once())->method('remove')->with($relation);
		$this->inject($this->subject, 'relationRepository', $relationRepository);

		$this->subject->deleteAction($relation);
	}
}
