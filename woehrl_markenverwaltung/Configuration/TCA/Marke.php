<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_woehrlmarkenverwaltung_domain_model_marke'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_woehrlmarkenverwaltung_domain_model_marke']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, marke, markelink, categorys',
	),
	//'types' => array(
		//'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, marke, markelink, categorys, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	//),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, marke, categorys, marke_has_lieferant, markelink')
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
				'foreign_table' => 'tx_woehrlmarkenverwaltung_domain_model_marke',
				'foreign_table_where' => 'AND tx_woehrlmarkenverwaltung_domain_model_marke.pid=###CURRENT_PID### AND tx_woehrlmarkenverwaltung_domain_model_marke.sys_language_uid IN (-1,0)',
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

		'marke' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_db.xlf:tx_woehrlmarkenverwaltung_domain_model_marke.marke',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'markelink' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_db.xlf:tx_woehrlmarkenverwaltung_domain_model_marke.markelink',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'categorys' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_db.xlf:tx_woehrlmarkenverwaltung_domain_model_marke.categorys',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlmarkenverwaltung_domain_model_category',
				'foreign_table_where' => 'ORDER BY tx_woehrlmarkenverwaltung_domain_model_category.uid',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		
	),
);
