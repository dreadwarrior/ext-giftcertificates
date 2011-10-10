<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Juhnke <tommy@van-tomas.de>, Profi Webmedia
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
class Tx_Giftcertificates_Controller_OrderingController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * orderingRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_OrderingRepository
	 */
	protected $orderingRepository;

	/**
	 * injectOrderingRepository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_OrderingRepository $orderingRepository
	 * @return void
	 */
	public function injectOrderingRepository(Tx_Giftcertificates_Domain_Repository_OrderingRepository $orderingRepository) {
		$this->orderingRepository = $orderingRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$orderings = $this->orderingRepository->findAll();
		$this->view->assign('orderings', $orderings);
	}

	/**
	 * action show
	 *
	 * @param $ordering
	 * @return void
	 */
	public function showAction(Tx_Giftcertificates_Domain_Model_Ordering $ordering) {
		$this->view->assign('ordering', $ordering);
	}

	/**
	 * action new
	 *
	 * @param $newOrdering
	 * @dontvalidate $newOrdering
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Ordering $newOrdering = NULL) {
		$this->view->assign('newOrdering', $newOrdering);
	}

	/**
	 * action create
	 *
	 * @param $newOrdering
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Ordering $newOrdering) {
		$this->orderingRepository->add($newOrdering);
		$this->flashMessageContainer->add('Your new Ordering was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $ordering
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Ordering $ordering) {
		$this->view->assign('ordering', $ordering);
	}

	/**
	 * action update
	 *
	 * @param $ordering
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_Ordering $ordering) {
		$this->orderingRepository->update($ordering);
		$this->flashMessageContainer->add('Your Ordering was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $ordering
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_Ordering $ordering) {
		$this->orderingRepository->remove($ordering);
		$this->flashMessageContainer->add('Your Ordering was removed.');
		$this->redirect('list');
	}

}
?>