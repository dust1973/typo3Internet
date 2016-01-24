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
 * Test case for class WOEHRL\WoehrlOnlinebefragung\Controller\QuestionController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class QuestionControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \WOEHRL\WoehrlOnlinebefragung\Controller\QuestionController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Controller\\QuestionController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllQuestionsFromRepositoryAndAssignsThemToView() {

		$allQuestions = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$questionRepository = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Domain\\Repository\\QuestionRepository', array('findAll'), array(), '', FALSE);
		$questionRepository->expects($this->once())->method('findAll')->will($this->returnValue($allQuestions));
		$this->inject($this->subject, 'questionRepository', $questionRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('questions', $allQuestions);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenQuestionToView() {
		$question = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('question', $question);

		$this->subject->showAction($question);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenQuestionToView() {
		$question = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newQuestion', $question);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($question);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenQuestionToQuestionRepository() {
		$question = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question();

		$questionRepository = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Domain\\Repository\\QuestionRepository', array('add'), array(), '', FALSE);
		$questionRepository->expects($this->once())->method('add')->with($question);
		$this->inject($this->subject, 'questionRepository', $questionRepository);

		$this->subject->createAction($question);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenQuestionToView() {
		$question = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('question', $question);

		$this->subject->editAction($question);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenQuestionInQuestionRepository() {
		$question = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question();

		$questionRepository = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Domain\\Repository\\QuestionRepository', array('update'), array(), '', FALSE);
		$questionRepository->expects($this->once())->method('update')->with($question);
		$this->inject($this->subject, 'questionRepository', $questionRepository);

		$this->subject->updateAction($question);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenQuestionFromQuestionRepository() {
		$question = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question();

		$questionRepository = $this->getMock('WOEHRL\\WoehrlOnlinebefragung\\Domain\\Repository\\QuestionRepository', array('remove'), array(), '', FALSE);
		$questionRepository->expects($this->once())->method('remove')->with($question);
		$this->inject($this->subject, 'questionRepository', $questionRepository);

		$this->subject->deleteAction($question);
	}
}
