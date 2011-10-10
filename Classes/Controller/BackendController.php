<?php
class Tx_Giftcertificates_Controller_BackendController extends Tx_Extbase_MVC_Controller_ActionController {
	public function indexAction() {
		$this->view->assign('foo', 'bar')
			->assign('bar', 'baz');
	}
}
?>