<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_woehrlgewinnspiele_domain_model_gewinnspiel'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_woehrlgewinnspiele_domain_model_gewinnspiel']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, subtitle, gewinnspieldatetimestart, gewinnspieldatetimestop, teasertext, teilnahmebedingungen, vorschaubild, titlebild, kassenbonn, description',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, subtitle;;;richtext:rte_transform[mode=ts_links], gewinnspieldatetimestart, gewinnspieldatetimestop, teasertext;;;richtext:rte_transform[mode=ts_links], teilnahmebedingungen;;;richtext:rte_transform[mode=ts_links], vorschaubild, titlebild, kassenbonn, description, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_woehrlgewinnspiele_domain_model_gewinnspiel',
				'foreign_table_where' => 'AND tx_woehrlgewinnspiele_domain_model_gewinnspiel.pid=###CURRENT_PID### AND tx_woehrlgewinnspiele_domain_model_gewinnspiel.sys_language_uid IN (-1,0)',
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

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'subtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.subtitle',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
		),
		'gewinnspieldatetimestart' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.gewinnspieldatetimestart',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'gewinnspieldatetimestop' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.gewinnspieldatetimestop',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'teasertext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.teasertext',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
		),
		'teilnahmebedingungen' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.teilnahmebedingungen',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
		),
		'vorschaubild' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.vorschaubild',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'vorschaubild',
				array('maxitems' => 1),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'titlebild' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.titlebild',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'titlebild',
				array('maxitems' => 1),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'kassenbonn' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.kassenbonn',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		
	),
);
