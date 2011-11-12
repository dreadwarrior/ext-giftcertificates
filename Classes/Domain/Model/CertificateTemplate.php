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
class Tx_Giftcertificates_Domain_Model_CertificateTemplate extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * is displayed in listing, in cart etc.
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * brief description of the certificate
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * TypoScript configuration for the certificate; mostly GIFBUILDER configuration
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $layout;

	/**
	 * small, thumbnail-sized preview image of the resulting certificate
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $previewImage;

	/**
	 * one or more images available for personalization
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $personalizationImage;

	/**
	 * defines the minimum value for value gift certificates
	 *
	 * @var float
	 */
	protected $minimumValue = 0.0;

	/**
	 * defines the maximum value for value gift certificates
	 *
	 * @var float
	 */
	protected $maximumValue = 0.0;

	/**
	 * if set, this is a property coupon, otherwise a value gift certificate
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Article>
	 */
	protected $articles;

	/**
	 * if set, this is a property coupon, otherwise a value gift certificate
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Category>
	 */
	protected $categories;

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
		
		$this->categories = new Tx_Extbase_Persistence_ObjectStorage();
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
	 * @return string $personalizationImage
	 */
	public function getPersonalizationImage() {
		return t3lib_div::trimExplode(',', $this->personalizationImage);
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
	 * determines if the gift certificate template is a property coupon or not
	 * 
	 * Property coupons consists of articles OR categories; otherwise - if the minimum value is set
	 * it's a value coupon.
	 * 
	 * @return boolean
	 */
	public function getIsPropertyCoupon() {
		if (0 < $this->categories->count()
				|| 0 < $this->articles->count()) {
			return TRUE;
		}

		return FALSE;
	}
}
?>