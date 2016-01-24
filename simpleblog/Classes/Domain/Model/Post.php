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
class Post extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * This is the title of the post
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * This is the description of the post
	 *
	 * @var \string
	 */
	protected $content;

	/**
	 * Date where the post was created
	 *
	 * @var \DateTime
	 */
	protected $postdate;

	/**
	 * Comments for a post
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Typovision\Simpleblog\Domain\Model\Comment>
	 * @lazy
	 */
	protected $comments;

	/**
	 * Author of a post
	 *
	 * @var \Typovision\Simpleblog\Domain\Model\Author
	 */
	protected $author;

	/**
	 * Tags of a post
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Typovision\Simpleblog\Domain\Model\Tag>
	 */
	protected $tags;

	/**
	 * __construct
	 *
	 * @return Post
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
		$this->comments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->tags = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the content
	 *
	 * @return \string $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Sets the content
	 *
	 * @param \string $content
	 * @return void
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * Returns the postdate
	 *
	 * @return \DateTime $postdate
	 */
	public function getPostdate() {
		return $this->postdate;
	}

	/**
	 * Sets the postdate
	 *
	 * @param \DateTime $postdate
	 * @return void
	 */
	public function setPostdate($postdate) {
		$this->postdate = $postdate;
	}

	/**
	 * Adds a Comment
	 *
	 * @param \Typovision\Simpleblog\Domain\Model\Comment $comment
	 * @return void
	 */
	public function addComment(\Typovision\Simpleblog\Domain\Model\Comment $comment) {
		$this->comments->attach($comment);
	}

	/**
	 * Removes a Comment
	 *
	 * @param \Typovision\Simpleblog\Domain\Model\Comment $commentToRemove The Comment to be removed
	 * @return void
	 */
	public function removeComment(\Typovision\Simpleblog\Domain\Model\Comment $commentToRemove) {
		$this->comments->detach($commentToRemove);
	}

	/**
	 * Returns the comments
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Typovision\Simpleblog\Domain\Model\Comment> $comments
	 */
	public function getComments() {
		return $this->comments;
	}

	/**
	 * Sets the comments
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Typovision\Simpleblog\Domain\Model\Comment> $comments
	 * @return void
	 */
	public function setComments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $comments) {
		$this->comments = $comments;
	}

	/**
	 * Returns the author
	 *
	 * @return \Typovision\Simpleblog\Domain\Model\Author $author
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Sets the author
	 *
	 * @param \Typovision\Simpleblog\Domain\Model\Author $author
	 * @return void
	 */
	public function setAuthor(\Typovision\Simpleblog\Domain\Model\Author $author) {
		$this->author = $author;
	}

	/**
	 * Adds a Tag
	 *
	 * @param \Typovision\Simpleblog\Domain\Model\Tag $tag
	 * @return void
	 */
	public function addTag(\Typovision\Simpleblog\Domain\Model\Tag $tag) {
		$this->tags->attach($tag);
	}

	/**
	 * Removes a Tag
	 *
	 * @param \Typovision\Simpleblog\Domain\Model\Tag $tagToRemove The Tag to be removed
	 * @return void
	 */
	public function removeTag(\Typovision\Simpleblog\Domain\Model\Tag $tagToRemove) {
		$this->tags->detach($tagToRemove);
	}

	/**
	 * Returns the tags
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Typovision\Simpleblog\Domain\Model\Tag> $tags
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * Sets the tags
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Typovision\Simpleblog\Domain\Model\Tag> $tags
	 * @return void
	 */
	public function setTags(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $tags) {
		$this->tags = $tags;
	}

}
?>