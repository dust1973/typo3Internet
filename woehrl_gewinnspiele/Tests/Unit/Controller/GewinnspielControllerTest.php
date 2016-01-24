<?php
namespace WOEHRL\WoehrlGewinnspiele\Tests\Unit\Controller;
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
 * Test case for class WOEHRL\WoehrlGewinnspiele\Controller\GewinnspielController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class GewinnspielControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \WOEHRL\WoehrlGewinnspiele\Controller\GewinnspielController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('WOEHRL\\WoehrlGewinnspiele\\Controller\\GewinnspielController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllGewinnspielsFromRepositoryAndAssignsThemToView() {

		$allGewinnspiels = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$gewinnspielRepository = $this->getMock('WOEHRL\\WoehrlGewinnspiele\\Domain\\Repository\\GewinnspielRepository', array('findAll'), array(), '', FALSE);
		$gewinnspielRepository->expects($this->once())->method('findAll')->will($this->returnValue($allGewinnspiels));
		$this->inject($this->subject, 'gewinnspielRepository', $gewinnspielRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('gewinnspiels', $allGewinnspiels);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenGewinnspielToView() {
		$gewinnspiel = new \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('gewinnspiel', $gewinnspiel);

		$this->subject->showAction($gewinnspiel);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenGewinnspielToView() {
		$gewinnspiel = new \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newGewinnspiel', $gewinnspiel);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($gewinnspiel);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenGewinnspielToGewinnspielRepository() {
		$gewinnspiel = new \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel();

		$gewinnspielRepository = $this->getMock('WOEHRL\\WoehrlGewinnspiele\\Domain\\Repository\\GewinnspielRepository', array('add'), array(), '', FALSE);
		$gewinnspielRepository->expects($this->once())->method('add')->with($gewinnspiel);
		$this->inject($this->subject, 'gewinnspielRepository', $gewinnspielRepository);

		$this->subject->createAction($gewinnspiel);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenGewinnspielToView() {
		$gewinnspiel = new \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('gewinnspiel', $gewinnspiel);

		$this->subject->editAction($gewinnspiel);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenGewinnspielInGewinnspielRepository() {
		$gewinnspiel = new \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel();

		$gewinnspielRepository = $this->getMock('WOEHRL\\WoehrlGewinnspiele\\Domain\\Repository\\GewinnspielRepository', array('update'), array(), '', FALSE);
		$gewinnspielRepository->expects($this->once())->method('update')->with($gewinnspiel);
		$this->inject($this->subject, 'gewinnspielRepository', $gewinnspielRepository);

		$this->subject->updateAction($gewinnspiel);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenGewinnspielFromGewinnspielRepository() {
		$gewinnspiel = new \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel();

		$gewinnspielRepository = $this->getMock('WOEHRL\\WoehrlGewinnspiele\\Domain\\Repository\\GewinnspielRepository', array('remove'), array(), '', FALSE);
		$gewinnspielRepository->expects($this->once())->method('remove')->with($gewinnspiel);
		$this->inject($this->subject, 'gewinnspielRepository', $gewinnspielRepository);

		$this->subject->deleteAction($gewinnspiel);
	}
}
