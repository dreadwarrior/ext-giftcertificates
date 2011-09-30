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
			'Certificate' => 'list, show, new, create, edit, update, delete',
+			'Article' => 'list, show, new, create, edit, update, delete',
+			'Order' => 'list, show, new, create, edit, update, delete',
+			'Category' => 'list, show, new, create, edit, update, delete',
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
		'label' => 'type',
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

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_article', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_article.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_article');
$TCA['tx_giftcertificates_domain_model_article'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_article',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Article.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_article.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_order', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_order.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_order');
$TCA['tx_giftcertificates_domain_model_order'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_order',
		'label' => 'order_number',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Order.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_order.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_orderitem', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_orderitem.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_orderitem');
$TCA['tx_giftcertificates_domain_model_orderitem'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_orderitem',
		'label' => 'identification',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/OrderItem.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_orderitem.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_category', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_category.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_category');
$TCA['tx_giftcertificates_domain_model_category'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_category',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_category.gif'
	),
);

?>