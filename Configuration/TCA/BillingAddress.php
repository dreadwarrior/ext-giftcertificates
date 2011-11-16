<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_giftcertificates_domain_model_billingaddress'] = array(
	'ctrl' => $TCA['tx_giftcertificates_domain_model_billingaddress']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, salutation, firstname, lastname, address, zip, city, country, email, phone',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, salutation, firstname, lastname, address, zip, city, country, email, phone,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_giftcertificates_domain_model_billingaddress',
				'foreign_table_where' => 'AND tx_giftcertificates_domain_model_billingaddress.pid=###CURRENT_PID### AND tx_giftcertificates_domain_model_billingaddress.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'salutation' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress.salutation',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'firstname' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress.firstname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'lastname' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress.lastname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress.address',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress.country',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'phone' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:giftcertificates/Resources/Private/Language/locallang_db.xml:tx_giftcertificates_domain_model_billingaddress.phone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
	),
);
?>