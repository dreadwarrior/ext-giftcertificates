<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Frontend',
	array(
		'CertificateTemplate' => 'list',
		'Article' => 'new, create, edit, update, delete',
		'Category' => 'new, create, edit, update, delete',
		'Ordering' => 'list, show, new, create, edit, update, delete',
		'Cart' => 'show, new, create, edit, update, delete',
		'Certificate' => 'show, new, create, edit, update, delete',
		'CertificateArticle' => 'new, create, edit, update, delete',
		'DoneeAddress' => 'new, create, edit, update, delete',
		'Payment' => 'new, create, edit, update, delete',
		'Shipping' => 'new, create, edit, update, delete',
		'ShippingAddress' => 'new, create, edit, update, delete',
		'BillingAddress' => 'new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'CertificateTemplate' => 'create, update, delete',
		'Article' => 'create, update, delete',
		'Category' => 'create, update, delete',
		'Ordering' => 'list, new, create, update, delete',
		'Cart' => 'create, update, delete',
		'Certificate' => 'create, update, delete',
		'CertificateArticle' => 'create, update, delete',
		'DoneeAddress' => 'create, update, delete',
		'Payment' => 'create, update, delete',
		'Shipping' => 'create, update, delete',
		'ShippingAddress' => 'create, update, delete',
		'BillingAddress' => 'create, update, delete',
		
	)
);

?>