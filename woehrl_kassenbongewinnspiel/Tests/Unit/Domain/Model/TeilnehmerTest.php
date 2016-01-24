<?php

namespace WOEHRL\WoehrlKassenbongewinnspiel\Tests\Unit\Domain\Model;

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
 * Test case for class \WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class TeilnehmerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model\Teilnehmer();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getGenderReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getGender()
		);
	}

	/**
	 * @test
	 */
	public function setGenderForIntegerSetsGender() {
		$this->subject->setGender(12);

		$this->assertAttributeEquals(
			12,
			'gender',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFirstnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstname()
		);
	}

	/**
	 * @test
	 */
	public function setFirstnameForStringSetsFirstname() {
		$this->subject->setFirstname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastname()
		);
	}

	/**
	 * @test
	 */
	public function setLastnameForStringSetsLastname() {
		$this->subject->setLastname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastname',
			$this->subject
		);
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
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getZip()
		);
	}

	/**
	 * @test
	 */
	public function setZipForStringSetsZip() {
		$this->subject->setZip('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'zip',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCity()
		);
	}

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() {
		$this->subject->setCity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'city',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAddressReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAddress()
		);
	}

	/**
	 * @test
	 */
	public function setAddressForStringSetsAddress() {
		$this->subject->setAddress('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'address',
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

	/**
	 * @test
	 */
	public function getWerbungReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getWerbung()
		);
	}

	/**
	 * @test
	 */
	public function setWerbungForBooleanSetsWerbung() {
		$this->subject->setWerbung(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'werbung',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFilialeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFiliale()
		);
	}

	/**
	 * @test
	 */
	public function setFilialeForStringSetsFiliale() {
		$this->subject->setFiliale('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'filiale',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKasseReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getKasse()
		);
	}

	/**
	 * @test
	 */
	public function setKasseForStringSetsKasse() {
		$this->subject->setKasse('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'kasse',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBonReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getBon()
		);
	}

	/**
	 * @test
	 */
	public function setBonForStringSetsBon() {
		$this->subject->setBon('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'bon',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBondatumReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getBondatum()
		);
	}

	/**
	 * @test
	 */
	public function setBondatumForDateTimeSetsBondatum() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setBondatum($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'bondatum',
			$this->subject
		);
	}
}
