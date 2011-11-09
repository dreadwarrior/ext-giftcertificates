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
class Tx_Giftcertificates_Controller_ArticleController extends Tx_Giftcertificates_MVC_Controller_ActionController {

	/**
	 * articleRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_ArticleRepository
	 */
	protected $articleRepository;

	/**
	 * injectArticleRepository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_ArticleRepository $articleRepository
	 * @return void
	 */
	public function injectArticleRepository(Tx_Giftcertificates_Domain_Repository_ArticleRepository $articleRepository) {
		$this->articleRepository = $articleRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$articles = $this->articleRepository->findAll();
		$this->view->assign('articles', $articles);
	}

	/**
	 * action new
	 *
	 * @param $newArticle
	 * @dontvalidate $newArticle
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Article $newArticle = NULL) {
		$this->view->assign('newArticle', $newArticle);
	}

	/**
	 * action create
	 *
	 * @param $newArticle
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Article $newArticle) {
		$this->articleRepository->add($newArticle);
		$this->flashMessageContainer->add('Your new Article was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $article
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Article $article) {
		$this->view->assign('article', $article);
	}

	/**
	 * action update
	 *
	 * @param $article
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_Article $article) {
		$this->articleRepository->update($article);
		$this->flashMessageContainer->add('Your Article was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $article
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_Article $article) {
		$this->articleRepository->remove($article);
		$this->flashMessageContainer->add('Your Article was removed.');
		$this->redirect('list');
	}

}
?>