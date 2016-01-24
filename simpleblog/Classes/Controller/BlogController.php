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

/**
 *
 *
 * @package simpleblog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BlogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * blogRepository
	 *
	 * @var \Typovision\Simpleblog\Domain\Repository\BlogRepository
	 * @inject
	 */
	protected $blogRepository;

	/**
	 * list action
	 *
	 * @param string $search
	 */
	public function listAction($search = '') {

		// alternative possibility to retrieve the POST Argument:
		#if ($this->request->hasArgument('search')) {
		#	$search = $this->request->getArgument('search');
		#}


		$limit = ($this->settings['blog']['max']) ?: NULL;

		$this->view->assign('blogs', $this->blogRepository->findSearchForm($search, $limit));
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->blogRepository->findSearchForm($search, $limit), 'settings');
		$this->view->assign('search', $search);
	}

	/**
	 * addForm action - provide a form to create a new blog
	 *
	 * @param Blog $blog
	 * @dontvalidate $blog
	 */
	public function addFormAction(Blog $blog = NULL) {



		$this->view->assign('blog', $blog);
	}

	/**
	 * add action - store new blog in database
	 *
	 * @param \Typovision\Simpleblog\Domain\Model\Blog $blog
	 * @validate $blog Typovision.Simpleblog:Facebook
	 */
	public function addAction(Blog $blog){
		$this->blogRepository->add($blog);
		$this->redirect('list');
	}

	/**
	 * show action - display a single blog
	 *
	 * @param Blog $blog
	 */
	public function showAction(Blog $blog) {


		$this->view->assign('blog', $blog);
	}

	/**
	 * updateForm action - provide a form to update a blog
	 *
	 * @param Blog $blog
	 * @dontvalidate $blog
	 */
	public function updateFormAction(Blog $blog = NULL) {
		$this->view->assign('blog', $blog);
	}

	/**
	 * update action - store the changed blog object in the database
	 *
	 * @param Blog $blog
	 */
	public function updateAction(Blog $blog) {
		$this->blogRepository->update($blog);
		$this->redirect('list');
	}

	/**
	 * delete confirmation action - ask for confirmation before deletion
	 *
	 * @param Blog $blog
	 */
	public function deleteConfirmAction(Blog $blog) {
		$this->view->assign('blog', $blog);
	}

	/**
	 * delete action - deletes a blog
	 * @param Blog $blog
	 */
	public function deleteAction(Blog $blog) {
		$this->blogRepository->remove($blog);
		$this->redirect('list');
	}
}
?>