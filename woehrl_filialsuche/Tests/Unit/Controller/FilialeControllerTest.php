<?php
namespace Woehrl\WoehrlFilialsuche\Tests\Unit\Controller;
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
 * Test case for class Woehrl\WoehrlFilialsuche\Controller\FilialeController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class FilialeControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlFilialsuche\Controller\FilialeController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlFilialsuche\\Controller\\FilialeController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFilialesFromRepositoryAndAssignsThemToView() {

		$allFiliales = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$filialeRepository = $this->getMock('Woehrl\\WoehrlFilialsuche\\Domain\\Repository\\FilialeRepository', array('findAll'), array(), '', FALSE);
		$filialeRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFiliales));
		$this->inject($this->subject, 'filialeRepository', $filialeRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('filiales', $allFiliales);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFilialeToView() {
		$filiale = new \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('filiale', $filiale);

		$this->subject->showAction($filiale);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenFilialeToView() {
		$filiale = new \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newFiliale', $filiale);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($filiale);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFilialeToFilialeRepository() {
		$filiale = new \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale();

		$filialeRepository = $this->getMock('Woehrl\\WoehrlFilialsuche\\Domain\\Repository\\FilialeRepository', array('add'), array(), '', FALSE);
		$filialeRepository->expects($this->once())->method('add')->with($filiale);
		$this->inject($this->subject, 'filialeRepository', $filialeRepository);

		$this->subject->createAction($filiale);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenFilialeToView() {
		$filiale = new \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('filiale', $filiale);

		$this->subject->editAction($filiale);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenFilialeInFilialeRepository() {
		$filiale = new \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale();

		$filialeRepository = $this->getMock('Woehrl\\WoehrlFilialsuche\\Domain\\Repository\\FilialeRepository', array('update'), array(), '', FALSE);
		$filialeRepository->expects($this->once())->method('update')->with($filiale);
		$this->inject($this->subject, 'filialeRepository', $filialeRepository);

		$this->subject->updateAction($filiale);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenFilialeFromFilialeRepository() {
		$filiale = new \Woehrl\WoehrlFilialsuche\Domain\Model\Filiale();

		$filialeRepository = $this->getMock('Woehrl\\WoehrlFilialsuche\\Domain\\Repository\\FilialeRepository', array('remove'), array(), '', FALSE);
		$filialeRepository->expects($this->once())->method('remove')->with($filiale);
		$this->inject($this->subject, 'filialeRepository', $filialeRepository);

		$this->subject->deleteAction($filiale);
	}
}
