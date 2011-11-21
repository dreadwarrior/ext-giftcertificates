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
 * domain model object
 *
 * @package giftcertificates
 * @subpackage Domain\Model
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Domain_Model_Category extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * displayTitle
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $displayTitle;

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * articles
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Article>
	 */
	protected $articles;

	/**
	 * parentCategory
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Category
	 */
	protected $parentCategory;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->articles = new Tx_Extbase_Persistence_ObjectStorage();
	}

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
	 * Returns the displayTitle
	 *
	 * @return string $displayTitle
	 */
	public function getDisplayTitle() {
		return $this->displayTitle;
	}

	/**
	 * Sets the displayTitle
	 *
	 * @param string $displayTitle
	 * @return void
	 */
	public function setDisplayTitle($displayTitle) {
		$this->displayTitle = $displayTitle;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Adds a Article
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Article $article
	 * @return void
	 */
	public function addArticle(Tx_Giftcertificates_Domain_Model_Article $article) {
		$this->articles->attach($article);
	}

	/**
	 * Removes a Article
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Article $articleToRemove The Article to be removed
	 * @return void
	 */
	public function removeArticle(Tx_Giftcertificates_Domain_Model_Article $articleToRemove) {
		$this->articles->detach($articleToRemove);
	}

	/**
	 * Returns the articles
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Article> $articles
	 */
	public function getArticles() {
		return $this->articles;
	}

	/**
	 * Sets the articles
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Article> $articles
	 * @return void
	 */
	public function setArticles(Tx_Extbase_Persistence_ObjectStorage $articles) {
		$this->articles = $articles;
	}

	/**
	 * Returns the parentCategory
	 *
	 * @return Tx_Giftcertificates_Domain_Model_Category $parentCategory
	 */
	public function getParentCategory() {
		return $this->parentCategory;
	}

	/**
	 * Sets the parentCategory
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Category $parentCategory
	 * @return void
	 */
	public function setParentCategory(Tx_Giftcertificates_Domain_Model_Category $parentCategory) {
		$this->parentCategory = $parentCategory;
	}

}
?>