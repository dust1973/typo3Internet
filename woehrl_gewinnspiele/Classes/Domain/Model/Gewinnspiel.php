<?php
namespace WOEHRL\WoehrlGewinnspiele\Domain\Model;


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
 * Gewinnspiel
 */
class Gewinnspiel extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * subtitle
	 *
	 * @var string
	 */
	protected $subtitle = '';

	/**
	 * gewinnspieldatetimestart
	 *
	 * @var \DateTime
	 */
	protected $gewinnspieldatetimestart = NULL;

	/**
	 * gewinnspieldatetimestop
	 *
	 * @var \DateTime
	 */
	protected $gewinnspieldatetimestop = NULL;

	/**
	 * teasertext
	 *
	 * @var string
	 */
	protected $teasertext = '';

	/**
	 * teilnahmebedingungen
	 *
	 * @var string
	 */
	protected $teilnahmebedingungen = '';

	/**
	 * vorschaubild
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $vorschaubild = NULL;

	/**
	 * titlebild
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $titlebild = NULL;

	/**
	 * kassenbonn
	 *
	 * @var boolean
	 */
	protected $kassenbonn = FALSE;

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the subtitle
	 *
	 * @return string $subtitle
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * Sets the subtitle
	 *
	 * @param string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}

	/**
	 * Returns the gewinnspieldatetimestart
	 *
	 * @return \DateTime $gewinnspieldatetimestart
	 */
	public function getGewinnspieldatetimestart() {
		return $this->gewinnspieldatetimestart;
	}

	/**
	 * Sets the gewinnspieldatetimestart
	 *
	 * @param \DateTime $gewinnspieldatetimestart
	 * @return void
	 */
	public function setGewinnspieldatetimestart(\DateTime $gewinnspieldatetimestart) {
		$this->gewinnspieldatetimestart = $gewinnspieldatetimestart;
	}

	/**
	 * Returns the gewinnspieldatetimestop
	 *
	 * @return \DateTime $gewinnspieldatetimestop
	 */
	public function getGewinnspieldatetimestop() {
		return $this->gewinnspieldatetimestop;
	}

	/**
	 * Sets the gewinnspieldatetimestop
	 *
	 * @param \DateTime $gewinnspieldatetimestop
	 * @return void
	 */
	public function setGewinnspieldatetimestop(\DateTime $gewinnspieldatetimestop) {
		$this->gewinnspieldatetimestop = $gewinnspieldatetimestop;
	}

	/**
	 * Returns the teasertext
	 *
	 * @return string $teasertext
	 */
	public function getTeasertext() {
		return $this->teasertext;
	}

	/**
	 * Sets the teasertext
	 *
	 * @param string $teasertext
	 * @return void
	 */
	public function setTeasertext($teasertext) {
		$this->teasertext = $teasertext;
	}

	/**
	 * Returns the teilnahmebedingungen
	 *
	 * @return string $teilnahmebedingungen
	 */
	public function getTeilnahmebedingungen() {
		return $this->teilnahmebedingungen;
	}

	/**
	 * Sets the teilnahmebedingungen
	 *
	 * @param string $teilnahmebedingungen
	 * @return void
	 */
	public function setTeilnahmebedingungen($teilnahmebedingungen) {
		$this->teilnahmebedingungen = $teilnahmebedingungen;
	}

	/**
	 * Returns the vorschaubild
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $vorschaubild
	 */
	public function getVorschaubild() {
		return $this->vorschaubild;
	}

	/**
	 * Sets the vorschaubild
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $vorschaubild
	 * @return void
	 */
	public function setVorschaubild(\TYPO3\CMS\Extbase\Domain\Model\FileReference $vorschaubild) {
		$this->vorschaubild = $vorschaubild;
	}

	/**
	 * Returns the titlebild
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $titlebild
	 */
	public function getTitlebild() {
		return $this->titlebild;
	}

	/**
	 * Sets the titlebild
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $titlebild
	 * @return void
	 */
	public function setTitlebild(\TYPO3\CMS\Extbase\Domain\Model\FileReference $titlebild) {
		$this->titlebild = $titlebild;
	}

	/**
	 * Returns the kassenbonn
	 *
	 * @return boolean $kassenbonn
	 */
	public function getKassenbonn() {
		return $this->kassenbonn;
	}

	/**
	 * Sets the kassenbonn
	 *
	 * @param boolean $kassenbonn
	 * @return void
	 */
	public function setKassenbonn($kassenbonn) {
		$this->kassenbonn = $kassenbonn;
	}

	/**
	 * Returns the boolean state of kassenbonn
	 *
	 * @return boolean
	 */
	public function isKassenbonn() {
		return $this->kassenbonn;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

}