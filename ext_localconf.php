<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Frontend',
	array(
		'Workflow' => 'index, show, order',
		'Certificate' => 'list, show',
		'Article' => 'list, show',
		'Ordering' => 'list, show, new, create, edit, update, delete',
		'Category' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Certificate' => 'create, update, delete',
		'Article' => 'create, update, delete',
		'Ordering' => 'create, update, delete',
		'Category' => 'create, update, delete',
		
	)
);

?>