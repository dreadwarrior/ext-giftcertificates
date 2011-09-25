<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Gcfrontend',
	array(
		'Certificate' => 'show, list, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Certificate' => 'create, update, delete',
		
	)
);

?>