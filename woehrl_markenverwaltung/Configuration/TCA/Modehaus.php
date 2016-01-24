<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_woehrlmarkenverwaltung_domain_model_modehaus'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_woehrlmarkenverwaltung_domain_model_modehaus']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => '
		hidden,
		haus,
		hausnummer,
		categorys',
	),
	'types' => array(
		'0' => array('showitem' => '--div--;General,hidden;;1;;1-1-1,
		haus, hausnummer,
		--div--; Herren, haus_hat_herrenmarken,
		--div--; Damen, haus_hat_damenmarken,
		--div--; Kinder, haus_hat_kindermarken,
		--div--; Sport, haus_hat_sportmarken,
		--div--; ueins, haus_hat_ueinsmarken
		'),
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
				'foreign_table' => 'tx_woehrlmarkenverwaltung_domain_model_modehaus',
				'foreign_table_where' => 'AND tx_woehrlmarkenverwaltung_domain_model_modehaus.pid=###CURRENT_PID### AND tx_woehrlmarkenverwaltung_domain_model_modehaus.sys_language_uid IN (-1,0)',
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

		'haus' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_db.xlf:tx_woehrlmarkenverwaltung_domain_model_modehaus.haus',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'hausnummer' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_db.xlf:tx_woehrlmarkenverwaltung_domain_model_modehaus.hausnummer',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'haus_hat_herrenmarken' => array (
			'exclude' => 0,
			'label' => 'Marke',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'tx_woehrlmarkenverwaltung_domain_model_marke',
				'foreign_table_where' => '
				AND tx_woehrlmarkenverwaltung_domain_model_marke.categorys = 1
				AND tx_woehrlmarkenverwaltung_domain_model_marke.hidden = 0
				AND tx_woehrlmarkenverwaltung_domain_model_marke.deleted = 0
				ORDER BY tx_woehrlmarkenverwaltung_domain_model_marke.marke ',
				'size' => 180,
				'minitems' => 0,
				'renderMode' => 'checkbox',
				'maxitems' => 1000,
				"MM" => "tx_woehrlmarkenverwaltung_haus_hat_herrenmarken_mm",
			)
		),
		'haus_hat_damenmarken' => array (
			'exclude' => 0,
			'label' => 'Marke',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'tx_woehrlmarkenverwaltung_domain_model_marke',
				'foreign_table_where' => '
				AND tx_woehrlmarkenverwaltung_domain_model_marke.categorys = 2
				AND tx_woehrlmarkenverwaltung_domain_model_marke.hidden = 0
				AND tx_woehrlmarkenverwaltung_domain_model_marke.deleted = 0
				ORDER BY tx_woehrlmarkenverwaltung_domain_model_marke.marke ',
				'size' => 180,
				'minitems' => 0,
				'renderMode' => 'checkbox',
				'maxitems' => 1000,
				"MM" => "tx_woehrlmarkenverwaltung_haus_hat_damenmarken_mm",
			)
		),
		'haus_hat_kindermarken' => array (
			'exclude' => 0,
			'label' => 'Marke',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'tx_woehrlmarkenverwaltung_domain_model_marke',
				'foreign_table_where' => '
				AND tx_woehrlmarkenverwaltung_domain_model_marke.categorys = 4
				AND tx_woehrlmarkenverwaltung_domain_model_marke.hidden = 0
				AND tx_woehrlmarkenverwaltung_domain_model_marke.deleted = 0
				ORDER BY tx_woehrlmarkenverwaltung_domain_model_marke.marke ',
				'size' => 180,
				'minitems' => 0,
				'renderMode' => 'checkbox',
				'maxitems' => 1000,
				"MM" => "tx_woehrlmarkenverwaltung_haus_hat_kindermarken_mm",
			)
		),
		'haus_hat_sportmarken' => array (
			'exclude' => 0,
			'label' => 'Marke',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'tx_woehrlmarkenverwaltung_domain_model_marke',
				'foreign_table_where' => '
				AND tx_woehrlmarkenverwaltung_domain_model_marke.categorys = 3
				AND tx_woehrlmarkenverwaltung_domain_model_marke.hidden = 0
				AND tx_woehrlmarkenverwaltung_domain_model_marke.deleted = 0
				ORDER BY tx_woehrlmarkenverwaltung_domain_model_marke.marke ',
				'size' => 180,
				'minitems' => 0,
				'renderMode' => 'checkbox',
				'maxitems' => 1000,
				"MM" => "tx_woehrlmarkenverwaltung_haus_hat_sportmarken_mm",
			)
		),
		'haus_hat_ueinsmarken' => array (
			'exclude' => 0,
			'label' => 'Marke',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'tx_woehrlmarkenverwaltung_domain_model_marke',
				'foreign_table_where' => '
				AND tx_woehrlmarkenverwaltung_domain_model_marke.categorys = 5
				AND tx_woehrlmarkenverwaltung_domain_model_marke.hidden = 0
				AND tx_woehrlmarkenverwaltung_domain_model_marke.deleted = 0
				ORDER BY tx_woehrlmarkenverwaltung_domain_model_marke.marke ',
				'size' => 180,
				'minitems' => 0,
				'renderMode' => 'checkbox',
				'maxitems' => 1000,
				"MM" => "tx_woehrlmarkenverwaltung_haus_hat_ueinsmarken_mm",
			)
		),
		/*'categorys' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_db.xlf:tx_woehrlmarkenverwaltung_domain_model_modehaus.categorys',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlmarkenverwaltung_domain_model_category',
				'MM' => 'tx_woehrlmarkenverwaltung_modehaus_category_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_woehrlmarkenverwaltung_domain_model_category',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),*/

	),
);
