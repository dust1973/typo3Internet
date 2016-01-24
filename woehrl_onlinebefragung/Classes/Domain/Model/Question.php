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
 * Question
 */
class Question extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
	/**
	 * @return int
	 */
	public function getProzenterledigt()
	{
		return $this->prozenterledigt;
	}

	/**
	 * @param int $prozenterledigt
	 */
	public function setProzenterledigt($prozenterledigt)
	{
		$this->prozenterledigt = $prozenterledigt;
	}

	/**
	 * @return boolean
	 */
	public function isRequirefeld()
	{
		return $this->requirefeld;
	}

	/**
	 * @param boolean $requirefeld
	 */
	public function setRequirefeld($requirefeld)
	{
		$this->requirefeld = $requirefeld;
	}




	/**
	 * requirefeld
	 *
	 * @var boolean
	 */
	protected $requirefeld = False;

	/**
	 * prozenterledigt
	 *
	 * @var integer
	 */
	protected $prozenterledigt = '';

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * typ
	 *
	 * @var integer
	 */
	protected $typ = 0;

	/**
	 * answer1
	 *
	 * @var string
	 */
	protected $answer1 = '';

	/**
	 * nextquestion1
	 *
	 * @var integer
	 */
	protected $nextquestion1 = '';

	/**
	 * correct1
	 *
	 * @var boolean
	 */
	protected $correct1 = FALSE;

	/**
	 * answer2
	 *
	 * @var string
	 */
	protected $answer2 = '';

	/**
	 * nextquestion2
	 *
	 * @var integer
	 */
	protected $nextquestion2 = '';

	/**
	 * correct2
	 *
	 * @var boolean
	 */
	protected $correct2 = FALSE;

	/**
	 * answer3
	 *
	 * @var string
	 */
	protected $answer3 = '';

	/**
	 * nextquestion3
	 *
	 * @var integer
	 */
	protected $nextquestion3 = '';

	/**
	 * correct3
	 *
	 * @var boolean
	 */
	protected $correct3 = FALSE;

	/**
	 * answer4
	 *
	 * @var string
	 */
	protected $answer4 = '';

	/**
	 * nextquestion4
	 *
	 * @var integer
	 */
	protected $nextquestion4 = '';

	/**
	 * correct4
	 *
	 * @var boolean
	 */
	protected $correct4 = FALSE;

	/**
	 * answer5
	 *
	 * @var string
	 */
	protected $answer5 = '';

	/**
	 * nextquestion5
	 *
	 * @var integer
	 */
	protected $nextquestion5 = '';

	/**
	 * correct5
	 *
	 * @var boolean
	 */
	protected $correct5 = FALSE;

	/**
	 * relation
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation>
	 */
	protected $relation = NULL;

	/**
	 * category
	 *
	 * @var \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Category
	 */
	protected $category = NULL;

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
	 * Returns the answer1
	 *
	 * @return string $answer1
	 */
	public function getAnswer1() {
		return $this->answer1;
	}

	/**
	 * Sets the answer1
	 *
	 * @param string $answer1
	 * @return void
	 */
	public function setAnswer1($answer1) {
		$this->answer1 = $answer1;
	}

	/**
	 * Returns the correct1
	 *
	 * @return boolean $correct1
	 */
	public function getCorrect1() {
		return $this->correct1;
	}

	/**
	 * Sets the correct1
	 *
	 * @param boolean $correct1
	 * @return void
	 */
	public function setCorrect1($correct1) {
		$this->correct1 = $correct1;
	}

	/**
	 * Returns the boolean state of correct1
	 *
	 * @return boolean
	 */
	public function isCorrect1() {
		return $this->correct1;
	}

	/**
	 * Returns the answer2
	 *
	 * @return string $answer2
	 */
	public function getAnswer2() {
		return $this->answer2;
	}

	/**
	 * Sets the answer2
	 *
	 * @param string $answer2
	 * @return void
	 */
	public function setAnswer2($answer2) {
		$this->answer2 = $answer2;
	}

	/**
	 * Returns the correct2
	 *
	 * @return boolean $correct2
	 */
	public function getCorrect2() {
		return $this->correct2;
	}

	/**
	 * Sets the correct2
	 *
	 * @param boolean $correct2
	 * @return void
	 */
	public function setCorrect2($correct2) {
		$this->correct2 = $correct2;
	}

	/**
	 * Returns the boolean state of correct2
	 *
	 * @return boolean
	 */
	public function isCorrect2() {
		return $this->correct2;
	}

	/**
	 * Returns the answer3
	 *
	 * @return string $answer3
	 */
	public function getAnswer3() {
		return $this->answer3;
	}

	/**
	 * Sets the answer3
	 *
	 * @param string $answer3
	 * @return void
	 */
	public function setAnswer3($answer3) {
		$this->answer3 = $answer3;
	}

	/**
	 * Returns the correct3
	 *
	 * @return boolean $correct3
	 */
	public function getCorrect3() {
		return $this->correct3;
	}

	/**
	 * Sets the correct3
	 *
	 * @param boolean $correct3
	 * @return void
	 */
	public function setCorrect3($correct3) {
		$this->correct3 = $correct3;
	}

	/**
	 * Returns the boolean state of correct3
	 *
	 * @return boolean
	 */
	public function isCorrect3() {
		return $this->correct3;
	}

	/**
	 * Returns the answer4
	 *
	 * @return string $answer4
	 */
	public function getAnswer4() {
		return $this->answer4;
	}

	/**
	 * Sets the answer4
	 *
	 * @param string $answer4
	 * @return void
	 */
	public function setAnswer4($answer4) {
		$this->answer4 = $answer4;
	}

	/**
	 * Returns the correct4
	 *
	 * @return boolean $correct4
	 */
	public function getCorrect4() {
		return $this->correct4;
	}

	/**
	 * Sets the correct4
	 *
	 * @param boolean $correct4
	 * @return void
	 */
	public function setCorrect4($correct4) {
		$this->correct4 = $correct4;
	}

	/**
	 * Returns the boolean state of correct4
	 *
	 * @return boolean
	 */
	public function isCorrect4() {
		return $this->correct4;
	}

	/**
	 * Returns the answer5
	 *
	 * @return string $answer5
	 */
	public function getAnswer5() {
		return $this->answer5;
	}

	/**
	 * Sets the answer5
	 *
	 * @param string $answer5
	 * @return void
	 */
	public function setAnswer5($answer5) {
		$this->answer5 = $answer5;
	}

	/**
	 * Returns the correct5
	 *
	 * @return boolean $correct5
	 */
	public function getCorrect5() {
		return $this->correct5;
	}

	/**
	 * Sets the correct5
	 *
	 * @param boolean $correct5
	 * @return void
	 */
	public function setCorrect5($correct5) {
		$this->correct5 = $correct5;
	}

	/**
	 * Returns the boolean state of correct5
	 *
	 * @return boolean
	 */
	public function isCorrect5() {
		return $this->correct5;
	}

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->relation = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a Relation
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation
	 * @return void
	 */
	public function addRelation(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relation) {
		$this->relation->attach($relation);
	}

	/**
	 * Removes a Relation
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relationToRemove The Relation to be removed
	 * @return void
	 */
	public function removeRelation(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation $relationToRemove) {
		$this->relation->detach($relationToRemove);
	}

	/**
	 * Returns the relation
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation> $relation
	 */
	public function getRelation() {
		return $this->relation;
	}

	/**
	 * Sets the relation
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Relation> $relation
	 * @return void
	 */
	public function setRelation(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relation) {
		$this->relation = $relation;
	}

	/**
	 * Returns the typ
	 *
	 * @return integer $typ
	 */
	public function getTyp() {
		return $this->typ;
	}

	/**
	 * Sets the typ
	 *
	 * @param integer $typ
	 * @return void
	 */
	public function setTyp($typ) {
		$this->typ = $typ;
	}

	/**
	 * Returns the category
	 *
	 * @return \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Category $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param \WOEHRL\WoehrlOnlinebefragung\Domain\Model\Category $category
	 * @return void
	 */
	public function setCategory(\WOEHRL\WoehrlOnlinebefragung\Domain\Model\Category $category) {
		$this->category = $category;
	}

	/**
	 * Returns the nextquestion1
	 *
	 * @return integer nextquestion1
	 */
	public function getNextquestion1() {
		return $this->nextquestion1;
	}

	/**
	 * Sets the nextquestion1
	 *
	 * @param string $nextquestion1
	 * @return integer nextquestion1
	 */
	public function setNextquestion1($nextquestion1) {
		$this->nextquestion1 = $nextquestion1;
	}

	/**
	 * Returns the nextquestion2
	 *
	 * @return integer nextquestion2
	 */
	public function getNextquestion2() {
		return $this->nextquestion2;
	}

	/**
	 * Sets the nextquestion2
	 *
	 * @param string $nextquestion2
	 * @return integer nextquestion2
	 */
	public function setNextquestion2($nextquestion2) {
		$this->nextquestion2 = $nextquestion2;
	}

	/**
	 * Returns the nextquestion3
	 *
	 * @return integer nextquestion3
	 */
	public function getNextquestion3() {
		return $this->nextquestion3;
	}

	/**
	 * Sets the nextquestion3
	 *
	 * @param string $nextquestion3
	 * @return integer nextquestion3
	 */
	public function setNextquestion3($nextquestion3) {
		$this->nextquestion3 = $nextquestion3;
	}

	/**
	 * Returns the nextquestion4
	 *
	 * @return integer nextquestion4
	 */
	public function getNextquestion4() {
		return $this->nextquestion4;
	}

	/**
	 * Sets the nextquestion4
	 *
	 * @param string $nextquestion4
	 * @return integer nextquestion4
	 */
	public function setNextquestion4($nextquestion4) {
		$this->nextquestion4 = $nextquestion4;
	}

	/**
	 * Returns the nextquestion5
	 *
	 * @return integer nextquestion5
	 */
	public function getNextquestion5() {
		return $this->nextquestion5;
	}

	/**
	 * Sets the nextquestion5
	 *
	 * @param string $nextquestion5
	 * @return integer nextquestion5
	 */
	public function setNextquestion5($nextquestion5) {
		$this->nextquestion5 = $nextquestion5;
	}

}