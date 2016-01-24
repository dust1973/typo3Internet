<?php
namespace Woehrl\WoehrlFilialsuche\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Filiale
 */
class Filiale extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * modehaeuser
	 *
	 * @var array
	 */
	public $modehaeuser = NULL;


	/**
	 * zoom
	 *
	 * @var array
	 */
	public $zoom = '';

	/**
 	* lon_pos
 	*
 	* @var array
	 */
	public $lon_pos = '';


	/**
	 * lat_pos
	 *
	 * @var array
	 */
	public $lat_pos = '';

	/**
	 * name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * adresse
	 *
	 * @var string
	 */
	protected $adresse = '';

	/**
	 * @return string
	 */
	public function getPlz()
	{
		return $this->plz;
	}

	/**
	 * @param string $plz
	 */
	public function setPlz($plz)
	{
		$this->plz = $plz;
	}

	/**
	 * @return string
	 */
	public function getRadius()
	{
		return $this->radius;
	}

	/**
	 * @param string $radius
	 */
	public function setRadius($radius)
	{
		$this->radius = $radius;
	}

	/**
	 * plz
	 *
	 * @var string
	 */
	protected $plz = NULL;

	/**
	 * radius
	 *
	 * @var string
	 */
	protected $radius = '';

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the adresse
	 *
	 * @return string $adresse
	 */
	public function getAdresse() {
		return $this->adresse;
	}

	/**
	 * Sets the adresse
	 *
	 * @param string $adresse
	 * @return void
	 */
	public function setAdresse($adresse) {
		$this->adresse = $adresse;
	}

}