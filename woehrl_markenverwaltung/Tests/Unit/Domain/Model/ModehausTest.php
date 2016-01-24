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
 * Test case for class \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class ModehausTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Modehaus();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getHausReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getHaus()
		);
	}

	/**
	 * @test
	 */
	public function setHausForStringSetsHaus() {
		$this->subject->setHaus('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'haus',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHausnummerReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getHausnummer()
		);
	}

	/**
	 * @test
	 */
	public function setHausnummerForStringSetsHausnummer() {
		$this->subject->setHausnummer('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'hausnummer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategorysReturnsInitialValueForCategory() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getCategorys()
		);
	}

	/**
	 * @test
	 */
	public function setCategorysForObjectStorageContainingCategorySetsCategorys() {
		$category = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Category();
		$objectStorageHoldingExactlyOneCategorys = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneCategorys->attach($category);
		$this->subject->setCategorys($objectStorageHoldingExactlyOneCategorys);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneCategorys,
			'categorys',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addCategoryToObjectStorageHoldingCategorys() {
		$category = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Category();
		$categorysObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$categorysObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($category));
		$this->inject($this->subject, 'categorys', $categorysObjectStorageMock);

		$this->subject->addCategory($category);
	}

	/**
	 * @test
	 */
	public function removeCategoryFromObjectStorageHoldingCategorys() {
		$category = new \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Category();
		$categorysObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$categorysObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($category));
		$this->inject($this->subject, 'categorys', $categorysObjectStorageMock);

		$this->subject->removeCategory($category);

	}
}
