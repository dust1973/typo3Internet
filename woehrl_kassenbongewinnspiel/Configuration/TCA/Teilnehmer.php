<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, gender, firstname, lastname, title, email, zip, city, address, description, werbung, filiale, kasse, bon, bondatum',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, gender, firstname, lastname, title, email, zip, city, address, description, werbung, filiale, kasse, bon, bondatum, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer',
				'foreign_table_where' => 'AND tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.pid=###CURRENT_PID### AND tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
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
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
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

		'gender' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.gender',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'firstname' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.firstname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'lastname' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.lastname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'address' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.address',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.description',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'werbung' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.werbung',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'filiale' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.filiale',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'kasse' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.kasse',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bon' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.bon',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bondatum' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.bondatum',
			'config' => array(
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => '0000-00-00'
			),
		),
		
	),
);
