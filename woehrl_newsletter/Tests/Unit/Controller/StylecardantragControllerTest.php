<?php
namespace WOEHRL\WoehrlNewsletter\Tests\Unit\Controller;
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
 * Test case for class WOEHRL\WoehrlNewsletter\Controller\NewsletterController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class NewsletterControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \WOEHRL\WoehrlNewsletter\Controller\NewsletterController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('WOEHRL\\WoehrlNewsletter\\Controller\\NewsletterController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllNewslettersFromRepositoryAndAssignsThemToView() {

		$allNewsletters = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$NewsletterRepository = $this->getMock('WOEHRL\\WoehrlNewsletter\\Domain\\Repository\\NewsletterRepository', array('findAll'), array(), '', FALSE);
		$NewsletterRepository->expects($this->once())->method('findAll')->will($this->returnValue($allNewsletters));
		$this->inject($this->subject, 'NewsletterRepository', $NewsletterRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('Newsletters', $allNewsletters);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenNewsletterToView() {
		$Newsletter = new \WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('Newsletter', $Newsletter);

		$this->subject->showAction($Newsletter);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenNewsletterToView() {
		$Newsletter = new \WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newNewsletter', $Newsletter);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($Newsletter);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenNewsletterToNewsletterRepository() {
		$Newsletter = new \WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter();

		$NewsletterRepository = $this->getMock('WOEHRL\\WoehrlNewsletter\\Domain\\Repository\\NewsletterRepository', array('add'), array(), '', FALSE);
		$NewsletterRepository->expects($this->once())->method('add')->with($Newsletter);
		$this->inject($this->subject, 'NewsletterRepository', $NewsletterRepository);

		$this->subject->createAction($Newsletter);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenNewsletterToView() {
		$Newsletter = new \WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('Newsletter', $Newsletter);

		$this->subject->editAction($Newsletter);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenNewsletterInNewsletterRepository() {
		$Newsletter = new \WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter();

		$NewsletterRepository = $this->getMock('WOEHRL\\WoehrlNewsletter\\Domain\\Repository\\NewsletterRepository', array('update'), array(), '', FALSE);
		$NewsletterRepository->expects($this->once())->method('update')->with($Newsletter);
		$this->inject($this->subject, 'NewsletterRepository', $NewsletterRepository);

		$this->subject->updateAction($Newsletter);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenNewsletterFromNewsletterRepository() {
		$Newsletter = new \WOEHRL\WoehrlNewsletter\Domain\Model\Newsletter();

		$NewsletterRepository = $this->getMock('WOEHRL\\WoehrlNewsletter\\Domain\\Repository\\NewsletterRepository', array('remove'), array(), '', FALSE);
		$NewsletterRepository->expects($this->once())->method('remove')->with($Newsletter);
		$this->inject($this->subject, 'NewsletterRepository', $NewsletterRepository);

		$this->subject->deleteAction($Newsletter);
	}
}
