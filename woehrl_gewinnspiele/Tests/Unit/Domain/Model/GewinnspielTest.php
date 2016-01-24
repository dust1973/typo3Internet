<?php

namespace WOEHRL\WoehrlGewinnspiele\Tests\Unit\Domain\Model;

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
 * Test case for class \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class GewinnspielTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \WOEHRL\WoehrlGewinnspiele\Domain\Model\Gewinnspiel();
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
	public function getSubtitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSubtitle()
		);
	}

	/**
	 * @test
	 */
	public function setSubtitleForStringSetsSubtitle() {
		$this->subject->setSubtitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'subtitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGewinnspieldatetimestartReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getGewinnspieldatetimestart()
		);
	}

	/**
	 * @test
	 */
	public function setGewinnspieldatetimestartForDateTimeSetsGewinnspieldatetimestart() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setGewinnspieldatetimestart($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'gewinnspieldatetimestart',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGewinnspieldatetimestopReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getGewinnspieldatetimestop()
		);
	}

	/**
	 * @test
	 */
	public function setGewinnspieldatetimestopForDateTimeSetsGewinnspieldatetimestop() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setGewinnspieldatetimestop($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'gewinnspieldatetimestop',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTeasertextReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTeasertext()
		);
	}

	/**
	 * @test
	 */
	public function setTeasertextForStringSetsTeasertext() {
		$this->subject->setTeasertext('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'teasertext',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTeilnahmebedingungenReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTeilnahmebedingungen()
		);
	}

	/**
	 * @test
	 */
	public function setTeilnahmebedingungenForStringSetsTeilnahmebedingungen() {
		$this->subject->setTeilnahmebedingungen('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'teilnahmebedingungen',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVorschaubildReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getVorschaubild()
		);
	}

	/**
	 * @test
	 */
	public function setVorschaubildForFileReferenceSetsVorschaubild() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setVorschaubild($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'vorschaubild',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTitlebildReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getTitlebild()
		);
	}

	/**
	 * @test
	 */
	public function setTitlebildForFileReferenceSetsTitlebild() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setTitlebild($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'titlebild',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKassenbonnReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getKassenbonn()
		);
	}

	/**
	 * @test
	 */
	public function setKassenbonnForBooleanSetsKassenbonn() {
		$this->subject->setKassenbonn(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'kassenbonn',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}
}
