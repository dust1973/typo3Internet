<?php
namespace Woehrl\WoehrlMarkenverwaltung\Tests\Unit\Controller;
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
 * Test case for class Woehrl\WoehrlMarkenverwaltung\Controller\MarkeController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class MarkeControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlMarkenverwaltung\Controller\MarkeController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Controller\\MarkeController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMarkesFromRepositoryAndAssignsThemToView() {

		$allMarkes = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$markeRepository = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Domain\\Repository\\MarkeRepository', array('findAll'), array(), '', FALSE);
		$markeRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMarkes));
		$this->inject($this->subject, 'markeRepository', $markeRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('markes', $allMarkes);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenMarkeToView() {
		$marke = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('marke', $marke);

		$this->subject->showAction($marke);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenMarkeToView() {
		$marke = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newMarke', $marke);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($marke);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenMarkeToMarkeRepository() {
		$marke = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke();

		$markeRepository = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Domain\\Repository\\MarkeRepository', array('add'), array(), '', FALSE);
		$markeRepository->expects($this->once())->method('add')->with($marke);
		$this->inject($this->subject, 'markeRepository', $markeRepository);

		$this->subject->createAction($marke);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenMarkeToView() {
		$marke = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('marke', $marke);

		$this->subject->editAction($marke);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenMarkeInMarkeRepository() {
		$marke = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke();

		$markeRepository = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Domain\\Repository\\MarkeRepository', array('update'), array(), '', FALSE);
		$markeRepository->expects($this->once())->method('update')->with($marke);
		$this->inject($this->subject, 'markeRepository', $markeRepository);

		$this->subject->updateAction($marke);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenMarkeFromMarkeRepository() {
		$marke = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke();

		$markeRepository = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Domain\\Repository\\MarkeRepository', array('remove'), array(), '', FALSE);
		$markeRepository->expects($this->once())->method('remove')->with($marke);
		$this->inject($this->subject, 'markeRepository', $markeRepository);

		$this->subject->deleteAction($marke);
	}
}
