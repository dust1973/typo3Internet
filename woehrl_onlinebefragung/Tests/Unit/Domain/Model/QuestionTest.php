<?php

namespace WOEHRL\WoehrlOnlinebefragung\Tests\Unit\Domain\Model;

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
 * Test case for class \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class QuestionTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Question();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTypReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getTyp()
		);
	}

	/**
	 * @test
	 */
	public function setTypForIntegerSetsTyp() {
		$this->subject->setTyp(12);

		$this->assertAttributeEquals(
			12,
			'typ',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswer1ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAnswer1()
		);
	}

	/**
	 * @test
	 */
	public function setAnswer1ForStringSetsAnswer1() {
		$this->subject->setAnswer1('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'answer1',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNextquestion1ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getNextquestion1()
		);
	}

	/**
	 * @test
	 */
	public function setNextquestion1ForIntegerSetsNextquestion1() {
		$this->subject->setNextquestion1(12);

		$this->assertAttributeEquals(
			12,
			'nextquestion1',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCorrect1ReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getCorrect1()
		);
	}

	/**
	 * @test
	 */
	public function setCorrect1ForBooleanSetsCorrect1() {
		$this->subject->setCorrect1(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'correct1',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswer2ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAnswer2()
		);
	}

	/**
	 * @test
	 */
	public function setAnswer2ForStringSetsAnswer2() {
		$this->subject->setAnswer2('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'answer2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNextquestion2ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getNextquestion2()
		);
	}

	/**
	 * @test
	 */
	public function setNextquestion2ForIntegerSetsNextquestion2() {
		$this->subject->setNextquestion2(12);

		$this->assertAttributeEquals(
			12,
			'nextquestion2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCorrect2ReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getCorrect2()
		);
	}

	/**
	 * @test
	 */
	public function setCorrect2ForBooleanSetsCorrect2() {
		$this->subject->setCorrect2(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'correct2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswer3ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAnswer3()
		);
	}

	/**
	 * @test
	 */
	public function setAnswer3ForStringSetsAnswer3() {
		$this->subject->setAnswer3('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'answer3',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNextquestion3ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getNextquestion3()
		);
	}

	/**
	 * @test
	 */
	public function setNextquestion3ForIntegerSetsNextquestion3() {
		$this->subject->setNextquestion3(12);

		$this->assertAttributeEquals(
			12,
			'nextquestion3',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCorrect3ReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getCorrect3()
		);
	}

	/**
	 * @test
	 */
	public function setCorrect3ForBooleanSetsCorrect3() {
		$this->subject->setCorrect3(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'correct3',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswer4ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAnswer4()
		);
	}

	/**
	 * @test
	 */
	public function setAnswer4ForStringSetsAnswer4() {
		$this->subject->setAnswer4('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'answer4',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNextquestion4ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getNextquestion4()
		);
	}

	/**
	 * @test
	 */
	public function setNextquestion4ForIntegerSetsNextquestion4() {
		$this->subject->setNextquestion4(12);

		$this->assertAttributeEquals(
			12,
			'nextquestion4',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCorrect4ReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getCorrect4()
		);
	}

	/**
	 * @test
	 */
	public function setCorrect4ForBooleanSetsCorrect4() {
		$this->subject->setCorrect4(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'correct4',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswer5ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAnswer5()
		);
	}

	/**
	 * @test
	 */
	public function setAnswer5ForStringSetsAnswer5() {
		$this->subject->setAnswer5('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'answer5',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNextquestion5ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getNextquestion5()
		);
	}

	/**
	 * @test
	 */
	public function setNextquestion5ForIntegerSetsNextquestion5() {
		$this->subject->setNextquestion5(12);

		$this->assertAttributeEquals(
			12,
			'nextquestion5',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCorrect5ReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getCorrect5()
		);
	}

	/**
	 * @test
	 */
	public function setCorrect5ForBooleanSetsCorrect5() {
		$this->subject->setCorrect5(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'correct5',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRelationReturnsInitialValueForRelation() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getRelation()
		);
	}

	/**
	 * @test
	 */
	public function setRelationForObjectStorageContainingRelationSetsRelation() {
		$relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation();
		$objectStorageHoldingExactlyOneRelation = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneRelation->attach($relation);
		$this->subject->setRelation($objectStorageHoldingExactlyOneRelation);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneRelation,
			'relation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addRelationToObjectStorageHoldingRelation() {
		$relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation();
		$relationObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$relationObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($relation));
		$this->inject($this->subject, 'relation', $relationObjectStorageMock);

		$this->subject->addRelation($relation);
	}

	/**
	 * @test
	 */
	public function removeRelationFromObjectStorageHoldingRelation() {
		$relation = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation();
		$relationObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$relationObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($relation));
		$this->inject($this->subject, 'relation', $relationObjectStorageMock);

		$this->subject->removeRelation($relation);

	}

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForCategory() {
		$this->assertEquals(
			NULL,
			$this->subject->getCategory()
		);
	}

	/**
	 * @test
	 */
	public function setCategoryForCategorySetsCategory() {
		$categoryFixture = new \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Category();
		$this->subject->setCategory($categoryFixture);

		$this->assertAttributeEquals(
			$categoryFixture,
			'category',
			$this->subject
		);
	}
}
