<?php

namespace Woehrl\WoehrlMarkenverwaltung\Tests\Unit\Domain\Model;

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
 * Test case for class \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class MarkeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getMarkeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMarke()
		);
	}

	/**
	 * @test
	 */
	public function setMarkeForStringSetsMarke() {
		$this->subject->setMarke('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'marke',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMarkelinkReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMarkelink()
		);
	}

	/**
	 * @test
	 */
	public function setMarkelinkForStringSetsMarkelink() {
		$this->subject->setMarkelink('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'markelink',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategorysReturnsInitialValueForCategory() {
		$this->assertEquals(
			NULL,
			$this->subject->getCategorys()
		);
	}

	/**
	 * @test
	 */
	public function setCategorysForCategorySetsCategorys() {
		$categorysFixture = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Category();
		$this->subject->setCategorys($categorysFixture);

		$this->assertAttributeEquals(
			$categorysFixture,
			'categorys',
			$this->subject
		);
	}
}
