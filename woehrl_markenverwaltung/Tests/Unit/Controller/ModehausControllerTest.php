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
 * Test case for class Woehrl\WoehrlMarkenverwaltung\Controller\ModehausController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class ModehausControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlMarkenverwaltung\Controller\ModehausController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Controller\\ModehausController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllModehausesFromRepositoryAndAssignsThemToView() {

		$allModehauses = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$modehausRepository = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Domain\\Repository\\ModehausRepository', array('findAll'), array(), '', FALSE);
		$modehausRepository->expects($this->once())->method('findAll')->will($this->returnValue($allModehauses));
		$this->inject($this->subject, 'modehausRepository', $modehausRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('modehauses', $allModehauses);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenModehausToView() {
		$modehaus = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('modehaus', $modehaus);

		$this->subject->showAction($modehaus);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenModehausToView() {
		$modehaus = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newModehaus', $modehaus);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($modehaus);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenModehausToModehausRepository() {
		$modehaus = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus();

		$modehausRepository = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Domain\\Repository\\ModehausRepository', array('add'), array(), '', FALSE);
		$modehausRepository->expects($this->once())->method('add')->with($modehaus);
		$this->inject($this->subject, 'modehausRepository', $modehausRepository);

		$this->subject->createAction($modehaus);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenModehausToView() {
		$modehaus = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('modehaus', $modehaus);

		$this->subject->editAction($modehaus);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenModehausInModehausRepository() {
		$modehaus = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus();

		$modehausRepository = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Domain\\Repository\\ModehausRepository', array('update'), array(), '', FALSE);
		$modehausRepository->expects($this->once())->method('update')->with($modehaus);
		$this->inject($this->subject, 'modehausRepository', $modehausRepository);

		$this->subject->updateAction($modehaus);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenModehausFromModehausRepository() {
		$modehaus = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus();

		$modehausRepository = $this->getMock('Woehrl\\WoehrlMarkenverwaltung\\Domain\\Repository\\ModehausRepository', array('remove'), array(), '', FALSE);
		$modehausRepository->expects($this->once())->method('remove')->with($modehaus);
		$this->inject($this->subject, 'modehausRepository', $modehausRepository);

		$this->subject->deleteAction($modehaus);
	}
}
