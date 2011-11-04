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
class Tx_Giftcertificates_Domain_Model_Template extends Tx_Extbase_DomainObject_AbstractEntity {

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
	 * layout
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $layout;

	/**
	 * previewImage
	 *
	 * @var string
	 */
	protected $previewImage;

	/**
	 * personalizationImage
	 *
	 * @var string
	 */
	protected $personalizationImage;

	/**
	 * minimumValue
	 *
	 * @var float
	 */
	protected $minimumValue;

	/**
	 * maximumValue
	 *
	 * @var float
	 */
	protected $maximumValue;

	/**
	 * categories
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Category>
	 */
	protected $categories;

	/**
	 * articles
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Article>
	 */
	protected $articles;

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
	 * Returns the layout
	 *
	 * @return string $layout
	 */
	public function getLayout() {
		return $this->layout;
	}

	/**
	 * Sets the layout
	 *
	 * @param string $layout
	 * @return void
	 */
	public function setLayout($layout) {
		$this->layout = $layout;
	}

	/**
	 * Returns the previewImage
	 *
	 * @return string $previewImage
	 */
	public function getPreviewImage() {
		return $this->previewImage;
	}

	/**
	 * Sets the previewImage
	 *
	 * @param string $previewImage
	 * @return void
	 */
	public function setPreviewImage($previewImage) {
		$this->previewImage = $previewImage;
	}

	/**
	 * Returns the personalizationImage
	 *
	 * @return array $personalizationImage
	 */
	public function getPersonalizationImage() {
    $personalizationImage = t3lib_div::trimExplode(',', $this->personalizationImage);;

    return $personalizationImage;
	}

	/**
	 * Sets the personalizationImage
	 *
	 * @param string $personalizationImage
	 * @return void
	 */
	public function setPersonalizationImage($personalizationImage) {
    $images = $this->getPersonalizationImage();
    $images[] = $personalizationImage;

    $images = implode(',', $images);
    $images = t3lib_div::uniqueList($images);

		$this->personalizationImage = $images;
	}

  /**
   * removes a personalization image from the image list field
   *
   * @param string $personalizationImage the image name
   * @return void
   */
  public function removePersonalizationImage($personalizationImage) {
    $images = t3lib_div::rmFromList($personalizationImage, $this->personalizationImage);

    $this->personalizationImage = $images;
  }

	/**
	 * Returns the minimumValue
	 *
	 * @return float $minimumValue
	 */
	public function getMinimumValue() {
		return $this->minimumValue;
	}

	/**
	 * Sets the minimumValue
	 *
	 * @param float $minimumValue
	 * @return void
	 */
	public function setMinimumValue($minimumValue) {
		$this->minimumValue = $minimumValue;
	}

	/**
	 * Returns the maximumValue
	 *
	 * @return float $maximumValue
	 */
	public function getMaximumValue() {
		return $this->maximumValue;
	}

	/**
	 * Sets the maximumValue
	 *
	 * @param float $maximumValue
	 * @return void
	 */
	public function setMaximumValue($maximumValue) {
		$this->maximumValue = $maximumValue;
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
		$this->categories = new Tx_Extbase_Persistence_ObjectStorage();
		
		$this->articles = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Adds a Category
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Category $category
	 * @return void
	 */
	public function addCategory(Tx_Giftcertificates_Domain_Model_Category $category) {
		$this->categories->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(Tx_Giftcertificates_Domain_Model_Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Category> $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Category> $categories
	 * @return void
	 */
	public function setCategories(Tx_Extbase_Persistence_ObjectStorage $categories) {
		$this->categories = $categories;
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

}
?>