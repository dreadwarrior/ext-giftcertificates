<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Gcfrontend',
	array(
		'Certificate' => 'list, show, new, create, edit, update, delete',
		'Article' => 'list, show, new, create, edit, update, delete',
		'Order' => 'list, show, new, create, edit, update, delete',
		'Category' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Certificate' => 'create, update, delete',
		'Article' => 'create, update, delete',
		'Order' => 'create, update, delete',
		'Category' => 'create, update, delete',
		
	)
);

?>