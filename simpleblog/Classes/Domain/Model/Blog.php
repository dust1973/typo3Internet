<?php
namespace Typovision\Simpleblog\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Patrick Lobacher <patrick.lobacher@typovision.de>, typovision GmbH
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
 *
 *
 * @package simpleblog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Blog extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * This is the title of the blog
	 *
	 * @var \string
	 * @validate NotEmpty, Typovision.Simpleblog:Word(max=3)
	 */
	protected $title;

	/**
	 * This is the description of the blog
	 *
	 * @var \string
	 */
	protected $description;

	/**
	 * Picture of the blog
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image;

	/**
	 * crdate
	 *
	 * @var DateTime
	 */
	protected $crdate;

	/**
	 * The posts of a blog
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Typovision\Simpleblog\Domain\Model\Post>
	 * @lazy
	 */
	protected $posts;

	/**
	 * __construct
	 *
	 * @return Blog
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->posts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 *
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 *
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * sets the Image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 *
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * get the Image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getImage() {
		return $this->image;
	}


	/**
	 * Adds a Post
	 *
	 * @param \Typovision\Simpleblog\Domain\Model\Post $post
	 *
	 * @return void
	 */
	public function addPost(\Typovision\Simpleblog\Domain\Model\Post $post) {
		$this->posts->attach($post);
	}

	/**
	 * Removes a Post
	 *
	 * @param \Typovision\Simpleblog\Domain\Model\Post $postToRemove The Post to be removed
	 *
	 * @return void
	 */
	public function removePost(\Typovision\Simpleblog\Domain\Model\Post $postToRemove) {
		$this->posts->detach($postToRemove);
	}

	/**
	 * Returns the posts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Typovision\Simpleblog\Domain\Model\Post> $posts
	 */
	public function getPosts() {
		return $this->posts;
	}

	/**
	 * Sets the posts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Typovision\Simpleblog\Domain\Model\Post> $posts
	 *
	 * @return void
	 */
	public function setPosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $posts) {
		$this->posts = $posts;
	}

	/**
	 * @param DateTime $crdate
	 *
	 * @return void
	 */
	public function setCrdate(DateTime $crdate) {
		$this->crdate = $crdate;
	}

	/**
	 * @return DateTime
	 */
	public function getCrdate() {
		return $this->crdate;
	}
}

?>