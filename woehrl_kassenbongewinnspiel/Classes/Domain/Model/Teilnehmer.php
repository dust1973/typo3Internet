<?php
namespace WOEHRL\WoehrlKassenbongewinnspiel\Domain\Model;

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
 * Teilnehmer
 */
class Teilnehmer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * hidden
	 *
	 * @var boolean
	 */
	protected $hidden = FALSE;

	/**
	 * gender
	 *
	 * @validate NotEmpty
	 * @var integer
	 */
	protected $gender = 0;

	/**
	 * firstname
	 *
	 * @validate NotEmpty
	 * @var string
	 */
	protected $firstname = '';

	/**
	 * lastname
	 *
	 * @validate NotEmpty
	 * @var string
	 */
	protected $lastname = '';

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * email
	 *
	 * @validate NotEmpty
     * @validate EmailAddress
     * WOEHRL\WoehrlKassenbongewinnspiel\Validation\Validator\EmailValidator
	 * @var string
	 */
	protected $email = '';

	/**
	 * zip
	 * @validate NotEmpty
	 * @var string
	 */
	protected $zip = '';

	/**
	 * city
	 *
	 * @validate NotEmpty
	 * @var string
	 */
	protected $city = '';

	/**
	 * address
	 *
	 * @validate NotEmpty
	 * @var string
	 */
	protected $address = '';

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * werbung
	 *
	 * @var boolean
	 */
	protected $werbung = FALSE;

	/**
	 * filiale
	 * @var string
     * @validate NotEmpty
	 */
	protected $filiale = '';

	/**
	 * kasse
	 * @var string
     * @validate NotEmpty
	 */
	protected $kasse = '';

	/**
	 * bon
	 * @validate NotEmpty
	 * @var string
	 */
	protected $bon = '';

	/**
	 * bondatum
     * @validate NotEmpty
	 *
	 * @var \string
	 */
	protected $bondatum = NULL;

	/**
	 * @return boolean
     *
	 */
	public function isHidden() {
		return $this->hidden;
	}

	/**
	 * @param boolean $hidden
	 */
	public function setHidden($hidden) {
		$this->hidden = $hidden;
	}

	/**
	 * Returns the boolean state of werbung
	 *
	 * @return boolean
	 */
	public function isWerbung() {
		return $this->werbung;
	}

	/**
	 * Returns the gender
	 *
	 * @return integer gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Sets the gender
	 *
	 * @param integer $gender
	 * @return integer gender
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * Returns the firstname
	 *
	 * @return string firstname
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * Sets the firstname
	 *
	 * @param string $firstname
	 * @return string firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * Returns the lastname
	 *
	 * @return string lastname
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * Sets the lastname
	 *
	 * @param string $lastname
	 * @return string lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * Returns the title
	 *
	 * @return string title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return string title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the email
	 *
	 * @return string email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return string email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the zip
	 *
	 * @return string zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return string zip
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return string city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return string city
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the address
	 *
	 * @return string address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param string $address
	 * @return string address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Returns the description
	 *
	 * @return string description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return string description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the werbung
	 *
	 * @return boolean werbung
	 */
	public function getWerbung() {
		return $this->werbung;
	}

	/**
	 * Sets the werbung
	 *
	 * @param boolean $werbung
	 * @return boolean werbung
	 */
	public function setWerbung($werbung) {
		$this->werbung = $werbung;
	}

	/**
	 * Returns the filiale
	 *
	 * @return string filiale
	 */
	public function getFiliale() {
		return $this->filiale;
	}

	/**
	 * Sets the filiale
	 *
	 * @param string $filiale
	 * @return string filiale
	 */
	public function setFiliale($filiale) {
		$this->filiale = $filiale;
	}

	/**
	 * Returns the kasse
	 *
	 * @return string kasse
	 */
	public function getKasse() {
		return $this->kasse;
	}

	/**
	 * Sets the kasse
	 *
	 * @param string $kasse
	 * @return string kasse
	 */
	public function setKasse($kasse) {
		$this->kasse = $kasse;
	}

	/**
	 * Returns the bon
	 *
	 * @return string bon
	 */
	public function getBon() {
		return $this->bon;
	}

	/**
	 * Sets the bon
	 *
	 * @param string $bon
	 * @return string bon
	 */
	public function setBon($bon) {
		$this->bon = $bon;
	}

	/**
	 * Returns the bondatum
	 *
	 * @return string bondatum
	 */
	public function getBondatum() {
		return $this->bondatum;
	}

	/**
	 * Sets the bondatum
	 *
	 * @param string $bondatum
	 * @return string bondatum
	 */
	public function setBondatum($bondatum) {
		$this->bondatum = $bondatum;
	}

}