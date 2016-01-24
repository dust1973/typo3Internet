<?php
namespace WOEHRL\WoehrlOnlinebefragung\Domain\Model;

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
 * Relation
 */
class Relation extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * userid
	 *
	 * @var string
	 */
	protected $userid = '';


	/**
	 * useremail
	 *
	 * @var string
	 */
	protected $useremail = '';

	/**
	 * Returns the userid
	 *
	 * @return string $userid
	 */
	public function getUserid() {
		return $this->userid;
	}

	/**
	 * Sets the userid
	 *
	 * @param string $userid
	 * @return void
	 */
	public function setUserid($userid) {
		$this->userid = $userid;
	}



	/**
	 * @return string
	 */
	public function getUseremail()
	{
		return $this->useremail;
	}

	/**
	 * @param string $useremail
	 */
	public function setUseremail($useremail)
	{
		$this->useremail = $useremail;
	}

	/**
	 * @return string
	 */
	public function getAnswer1()
	{
		return $this->answer1;
	}

	/**
	 * @param string $answer1
	 */
	public function setAnswer1($answer1)
	{
		$this->answer1 = $answer1;
	}

	/**
	 * @return string
	 */
	public function getAnswer2()
	{
		return $this->answer2;
	}

	/**
	 * @param string $answer2
	 */
	public function setAnswer2($answer2)
	{
		$this->answer2 = $answer2;
	}

	/**
	 * @return string
	 */
	public function getAnswer3()
	{
		return $this->answer3;
	}

	/**
	 * @param string $answer3
	 */
	public function setAnswer3($answer3)
	{
		$this->answer3 = $answer3;
	}

	/**
	 * @return string
	 */
	public function getAnswer4()
	{
		return $this->answer4;
	}

	/**
	 * @param string $answer4
	 */
	public function setAnswer4($answer4)
	{
		$this->answer4 = $answer4;
	}

	/**
	 * @return string
	 */
	public function getAnswer5()
	{
		return $this->answer5;
	}

	/**
	 * @param string $answer5
	 */
	public function setAnswer5($answer5)
	{
		$this->answer5 = $answer5;
	}


	/**
	 * answer1
	 *
	 * @var string
	 */
	protected $answer1 = '';

	/**
	 * answer2
	 *
	 * @var string
	 */
	protected $answer2 = '';

	/**
	 * answer3
	 *
	 * @var string
	 */
	protected $answer3 = '';

	/**
	 * answer4
	 *
	 * @var string
	 */
	protected $answer4 = '';

	/**
	 * answer5
	 *
	 * @var string
	 */
	protected $answer5 = '';

	/**
	 * @return string
	 */
	public function getFrage()
	{
		return $this->frage;
	}

	/**
	 * @param string $frage
	 */
	public function setFrage($frage)
	{
		$this->frage = $frage;
	}


	/**
	 * frage
	 *
	 * @var string
	 */
	protected $frage = '';


}