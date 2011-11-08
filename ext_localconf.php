<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Frontend',
	array(
		'Template' => 'list',
		'Category' => 'list',
		'Article' => 'list',
		'Certificate' => 'new, create, edit, update, delete',
		'Cart' => 'list, show, new, create, edit, update, delete',
		'Ordering' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Template' => 'create, update, delete',
		'Category' => 'create, update, delete',
		'Article' => 'create, update, delete',
		'Certificate' => 'create, update, delete',
		'Cart' => 'create, update, delete',
		'Ordering' => 'create, update, delete',
		
	)
);

?>