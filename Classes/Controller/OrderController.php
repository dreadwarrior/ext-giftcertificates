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
class Tx_Giftcertificates_Controller_OrderController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * orderRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_OrderRepository
	 */
	protected $orderRepository;

	/**
	 * injectOrderRepository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_OrderRepository $orderRepository
	 * @return void
	 */
	public function injectOrderRepository(Tx_Giftcertificates_Domain_Repository_OrderRepository $orderRepository) {
		$this->orderRepository = $orderRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$orders = $this->orderRepository->findAll();
		$this->view->assign('orders', $orders);
	}

	/**
	 * action show
	 *
	 * @param $order
	 * @return void
	 */
	public function showAction(Tx_Giftcertificates_Domain_Model_Order $order) {
		$this->view->assign('order', $order);
	}

	/**
	 * action new
	 *
	 * @param $newOrder
	 * @dontvalidate $newOrder
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Order $newOrder = NULL) {
		$this->view->assign('newOrder', $newOrder);
	}

	/**
	 * action create
	 *
	 * @param $newOrder
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Order $newOrder) {
		$this->orderRepository->add($newOrder);
		$this->flashMessageContainer->add('Your new Order was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $order
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Order $order) {
		$this->view->assign('order', $order);
	}

	/**
	 * action update
	 *
	 * @param $order
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_Order $order) {
		$this->orderRepository->update($order);
		$this->flashMessageContainer->add('Your Order was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $order
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_Order $order) {
		$this->orderRepository->remove($order);
		$this->flashMessageContainer->add('Your Order was removed.');
		$this->redirect('list');
	}

}
?>