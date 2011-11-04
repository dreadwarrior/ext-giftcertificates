<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Frontend',
	'Gift certificates ordering system'
);

//$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . frontend;
//$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' .frontend. '.xml');





if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'backend',	// Submodule key
		'',						// Position
		array(
			'Template' => 'list, new, create, edit, update, delete',
+			'Category' => 'list, new, create, edit, update, delete',
+			'Article' => 'list, new, create, edit, update, delete',
+			'Certificate' => 'new, create, edit, update, delete',
+			'Cart' => 'list, show, new, create, edit, update, delete',
+			'Ordering' => 'list, show, new, create, edit, update, delete',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_backend.xml',
		)
	);

}


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Gift certificate system');


t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_template', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_template.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_template');
$TCA['tx_giftcertificates_domain_model_template'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_template',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Template.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_template.gif'
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

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_certificate', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_certificate.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_certificate');
$TCA['tx_giftcertificates_domain_model_certificate'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_certificate',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Certificate.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_certificate.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_donee', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_donee.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_donee');
$TCA['tx_giftcertificates_domain_model_donee'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_donee',
		'label' => 'salutation',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Donee.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_donee.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_certificatearticle', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_certificatearticle.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_certificatearticle');
$TCA['tx_giftcertificates_domain_model_certificatearticle'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_certificatearticle',
		'label' => 'amount',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/CertificateArticle.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_certificatearticle.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_cart', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_cart.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_cart');
$TCA['tx_giftcertificates_domain_model_cart'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_cart',
		'label' => 'total_value',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Cart.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_cart.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_ordering', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_ordering.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_ordering');
$TCA['tx_giftcertificates_domain_model_ordering'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_ordering',
		'label' => 'ordering_number',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Ordering.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_ordering.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_shippingaddress', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_shippingaddress.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_shippingaddress');
$TCA['tx_giftcertificates_domain_model_shippingaddress'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_shippingaddress',
		'label' => 'salutation',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/ShippingAddress.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_shippingaddress.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_payment', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_payment.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_payment');
$TCA['tx_giftcertificates_domain_model_payment'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_payment',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Payment.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_payment.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_giftcertificates_domain_model_billingaddress', 'EXT:giftcertificates/Resources/Private/Language/locallang_csh_tx_giftcertificates_domain_model_billingaddress.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_giftcertificates_domain_model_billingaddress');
$TCA['tx_giftcertificates_domain_model_billingaddress'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress',
		'label' => 'salutation',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/BillingAddress.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_giftcertificates_domain_model_billingaddress.gif'
	),
);

?>