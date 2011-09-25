<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Gcfrontend',
	'Frontend'
);

//$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . gcfrontend;
//$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' .gcfrontend. '.xml');





if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'gcbackend',	// Submodule key
		'',						// Position
		array(
			'Certificate' => 'show, list, new, create, edit, update, delete',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_gcbackend.xml',
		)
	);

}


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Gift certificate system');


t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_certificate', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_certificate.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_certificate');
$TCA['tx_giftcertificates_domain_model_certificate'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_certificate',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Certificate.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_certificate.gif'
	),
);

?>