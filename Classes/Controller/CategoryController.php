<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Juhnke <tommy@van-tomas.de>
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
 * @package giftcertificates
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Controller_CategoryController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * categoryRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 * injectCategoryRepository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_CategoryRepository $categoryRepository
	 * @return void
	 */
	public function injectCategoryRepository(Tx_Giftcertificates_Domain_Repository_CategoryRepository $categoryRepository) {
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$categories = $this->categoryRepository->findAll();
		$this->view->assign('categories', $categories);
	}

	/**
	 * action new
	 *
	 * @param $newCategory
	 * @dontvalidate $newCategory
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Category $newCategory = NULL) {
		$this->view->assign('newCategory', $newCategory);
	}

	/**
	 * action create
	 *
	 * @param $newCategory
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Category $newCategory) {
		$this->categoryRepository->add($newCategory);
		$this->flashMessageContainer->add('Your new Category was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $category
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Category $category) {
		$this->view->assign('category', $category);
	}

	/**
	 * action update
	 *
	 * @param $category
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_Category $category) {
		$this->categoryRepository->update($category);
		$this->flashMessageContainer->add('Your Category was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $category
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_Category $category) {
		$this->categoryRepository->remove($category);
		$this->flashMessageContainer->add('Your Category was removed.');
		$this->redirect('list');
	}

}
?>