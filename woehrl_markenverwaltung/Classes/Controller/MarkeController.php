<?php
namespace Woehrl\WoehrlMarkenverwaltung\Controller;

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
 * MarkeController
 */
class MarkeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * markeRepository
	 *
	 * @var \Woehrl\WoehrlMarkenverwaltung\Domain\Repository\MarkeRepository
	 * @inject
	 */
	protected $markeRepository = NULL;

	/**
	 * categoryRepository
	 *
	 * @var \Woehrl\WoehrlMarkenverwaltung\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;


	/**
	 * action list
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Category $category
	 * @return void
	 */
	public function listAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Category $category = NULL) {
	


		switch ($this->settings['markenverwaltung']) {
			
			case 1:
				if ($this->settings['markenverwaltung']) {

					$modehaus = $this->settings['modehaus'];
					$categories = $this->categoryRepository->findAll();
					//$this->contentObj = $this->configurationManager->getContentObject();
	

					foreach ($categories as $category) {
						$categoryId = $category->getUid();
						$categoryName = strtolower($category->getKategoriename()) . 'marken';
						$marken = $this->markeRepository->getMarkenFromMMTabeles($modehaus, $categoryName, $categoryId);
						if($marken) {
							$sort = array();
							foreach ($marken as $marke) {
								$sort[$marke['anfangsbuchstabe']][] = $marke;
							}
							$markes[$categoryName] = $sort;
						}

					}
				}

				//$this->view->assign('markes', $markes);
				break;

			case 0:


				if($this->settings['category']) {
					$category = $this->categoryRepository->findByUid($this->settings['category']);
					$marken = $this->markeRepository->findByCategory($category);
					$sort = array();

					foreach ($marken as $marke) {
						$sort[$marke['anfangsbuchstabe']][] = $marke;
					}
					$markes = $sort;
				}else{
					$categories = $this->categoryRepository->findAll();

					foreach ($categories as $category) {
						$categoryId = $category->getUid();
						$categoryName = strtolower($category->getKategoriename()) . 'marken';
						$marken = $this->markeRepository->getMarkenFromMMTabeles($modehaus= NULL, $categoryName, $categoryId);
						$sort = array();
						foreach ($marken as $marke) {
							$sort[$marke['anfangsbuchstabe']][] = $marke;
						}
						$markes[$categoryName] = $sort;

					}
					$categories = $this->categoryRepository->findAll();
					//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($markes, 'markes');
					//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings, 'markes');
				}
				
				//$this->view->assign('requestCategory', $category->getUid());

				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($marken, 'markes');
			
				break;

		}

		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($markes, 'markes');
		//$markes = $this->markeRepository->findAll();
		$this->view->assign('markes', $markes);
	

	}

	/**
	 * action show
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $marke
	 * @return void
	 */
	public function showAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $marke) {
		$this->view->assign('marke', $marke);
	}

	/**
	 * action new
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $newMarke
	 * @ignorevalidation $newMarke
	 * @return void
	 */
	public function newAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $newMarke = NULL) {
		$this->view->assign('newMarke', $newMarke);
	}

	/**
	 * action create
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $newMarke
	 * @return void
	 */
	public function createAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $newMarke) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->markeRepository->add($newMarke);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $marke
	 * @ignorevalidation $marke
	 * @return void
	 */
	public function editAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $marke) {
		$this->view->assign('marke', $marke);
	}

	/**
	 * action update
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $marke
	 * @return void
	 */
	public function updateAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $marke) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->markeRepository->update($marke);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $marke
	 * @return void
	 */
	public function deleteAction(\Woehrl\WoehrlMarkenverwaltung\Domain\Model\Marke $marke) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->markeRepository->remove($marke);
		$this->redirect('list');
	}

	/**
	 * getDamenMarkenNachUidLocal
	 *
	 * @return Tx_Extbase_Persistence_QueryResultInterface The products
	 */



}