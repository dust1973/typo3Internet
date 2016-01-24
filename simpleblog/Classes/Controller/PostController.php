<?php
namespace Typovision\Simpleblog\Controller;

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
use Typovision\Simpleblog\Domain\Model\Blog;
use Typovision\Simpleblog\Domain\Model\Post;

/**
 *
 *
 * @package simpleblog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class PostController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * SignalSlotDispatcher
	 *
	 * @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher
	 * @inject
	 */
	protected $signalSlotDispatcher;

	/**
	 * addForm action - displays a form for adding a post
	 *
	 * @param Blog $blog
	 * @param Post $post
	 */
	public function addFormAction(
		Blog $blog,
		Post $post = NULL) {
		$this->view->assign('tags', $this->objectManager->get('Typovision\\Simpleblog\\Domain\\Repository\\TagRepository')->findAll());
		$this->view->assign('blog', $blog);
		$this->view->assign('post', $post);
	}

	/**
	 * add action - adds a post to the repository
	 *
	 * @param Blog $blog
	 * @param Post $post
	 */
	public function addAction(
		Blog $blog,
		Post $post) {
		$post->setPostdate(new \DateTime());
		$blog->addPost($post);
		$this->objectManager->get('Typovision\\Simpleblog\\Domain\\Repository\\BlogRepository')->update($blog);
		$this->redirect('show', 'Blog', NULL, array('blog' => $blog));
	}

	/**
	 * @param Blog $blog
	 * @param Post $post
	 */
	public function showAction(Blog $blog, Post $post) {
		$this->view->assign('blog', $blog);
		$this->view->assign('post', $post);
	}

	/**
	 * @param Blog $blog
	 * @param Post $post
	 */
	public function updateFormAction(Blog $blog, Post $post) {
		$this->view->assign('tags', $this->objectManager->get('Typovision\\Simpleblog\\Domain\\Repository\\TagRepository')->findAll());
		$this->view->assign('blog', $blog);
		$this->view->assign('post', $post);
	}

	/**
	 * @param Blog $blog
	 * @param Post $post
	 */
	public function updateAction(Blog $blog, Post $post) {
		$blog->removePost($post);
		$blog->addPost($post);
		$this->objectManager->get('Typovision\\Simpleblog\\Domain\\Repository\\BlogRepository')->update($blog);
		$this->redirect('show', 'Blog', NULL, array('blog' => $blog));
	}

	/**
	 * deleteConfirm action - displays a form for confirming the deletion of a post
	 *
	 * @param Blog $blog
	 * @param Post $post
	 */
	public function deleteConfirmAction(
		Blog $blog,
		Post $post) {
		$this->view->assign('blog', $blog);
		$this->view->assign('post', $post);
	}

	/**
	 * delete action - deletes a post in the repository
	 *
	 * @param Blog $blog
	 * @param Post $post
	 */
	public function deleteAction(
		Blog $blog,
		Post $post) {
		$blog->removePost($post);
		$this->objectManager->get('Typovision\\Simpleblog\\Domain\\Repository\\BlogRepository')->update($blog);
		$this->redirect('show', 'Blog', NULL, array('blog' => $blog));
	}

	/**
	 * @param \Typovision\Simpleblog\Domain\Model\Post $post
	 * @param \Typovision\Simpleblog\Domain\Model\Comment $comment
	 *
	 * @return bool|string
	 */
	public function ajaxAction(
		\Typovision\Simpleblog\Domain\Model\Post $post,
		\Typovision\Simpleblog\Domain\Model\Comment $comment = NULL) {

		// Wenn der Kommentar leer ist, wird nicht persistiert
		if ($comment->getComment() == "") {
			return FALSE;
		}

		// Datum des Kommentars setzen und den Kommentar zum Post hinzufügen
		$comment->setCommentdate(new \DateTime());
		$post->addComment($comment);

		// Signal für den Kommentar
		$this->signalSlotDispatcher->dispatch(
			__CLASS__,
			'beforeCommentCreation',
			array($comment, $post)
		);

		$postRepository = $this->objectManager->get('Typovision\\Simpleblog\\Domain\\Repository\\PostRepository');
		$postRepository->update($post);
		$this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();

		$comments = $post->getComments();
		foreach ($comments as $comment) {
			$json[$comment->getUid()] = array(
				'comment' => $comment->getComment(),
				'commentdate' => $comment->getCommentdate()
			);
		}
		return json_encode($json);
	}
}

?>