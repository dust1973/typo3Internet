<?php
namespace WOEHRL\WoehrlStylecardantrag\Tests\Unit\Controller;
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
 * Test case for class WOEHRL\WoehrlStylecardantrag\Controller\StylecardantragController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class StylecardantragControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \WOEHRL\WoehrlStylecardantrag\Controller\StylecardantragController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('WOEHRL\\WoehrlStylecardantrag\\Controller\\StylecardantragController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllStylecardantragsFromRepositoryAndAssignsThemToView() {

		$allStylecardantrags = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$stylecardantragRepository = $this->getMock('WOEHRL\\WoehrlStylecardantrag\\Domain\\Repository\\StylecardantragRepository', array('findAll'), array(), '', FALSE);
		$stylecardantragRepository->expects($this->once())->method('findAll')->will($this->returnValue($allStylecardantrags));
		$this->inject($this->subject, 'stylecardantragRepository', $stylecardantragRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('stylecardantrags', $allStylecardantrags);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenStylecardantragToView() {
		$stylecardantrag = new \WOEHRL\WoehrlStylecardantrag\Domain\Model\Stylecardantrag();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('stylecardantrag', $stylecardantrag);

		$this->subject->showAction($stylecardantrag);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenStylecardantragToView() {
		$stylecardantrag = new \WOEHRL\WoehrlStylecardantrag\Domain\Model\Stylecardantrag();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newStylecardantrag', $stylecardantrag);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($stylecardantrag);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenStylecardantragToStylecardantragRepository() {
		$stylecardantrag = new \WOEHRL\WoehrlStylecardantrag\Domain\Model\Stylecardantrag();

		$stylecardantragRepository = $this->getMock('WOEHRL\\WoehrlStylecardantrag\\Domain\\Repository\\StylecardantragRepository', array('add'), array(), '', FALSE);
		$stylecardantragRepository->expects($this->once())->method('add')->with($stylecardantrag);
		$this->inject($this->subject, 'stylecardantragRepository', $stylecardantragRepository);

		$this->subject->createAction($stylecardantrag);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenStylecardantragToView() {
		$stylecardantrag = new \WOEHRL\WoehrlStylecardantrag\Domain\Model\Stylecardantrag();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('stylecardantrag', $stylecardantrag);

		$this->subject->editAction($stylecardantrag);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenStylecardantragInStylecardantragRepository() {
		$stylecardantrag = new \WOEHRL\WoehrlStylecardantrag\Domain\Model\Stylecardantrag();

		$stylecardantragRepository = $this->getMock('WOEHRL\\WoehrlStylecardantrag\\Domain\\Repository\\StylecardantragRepository', array('update'), array(), '', FALSE);
		$stylecardantragRepository->expects($this->once())->method('update')->with($stylecardantrag);
		$this->inject($this->subject, 'stylecardantragRepository', $stylecardantragRepository);

		$this->subject->updateAction($stylecardantrag);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenStylecardantragFromStylecardantragRepository() {
		$stylecardantrag = new \WOEHRL\WoehrlStylecardantrag\Domain\Model\Stylecardantrag();

		$stylecardantragRepository = $this->getMock('WOEHRL\\WoehrlStylecardantrag\\Domain\\Repository\\StylecardantragRepository', array('remove'), array(), '', FALSE);
		$stylecardantragRepository->expects($this->once())->method('remove')->with($stylecardantrag);
		$this->inject($this->subject, 'stylecardantragRepository', $stylecardantragRepository);

		$this->subject->deleteAction($stylecardantrag);
	}
}
