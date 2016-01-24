<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_woehrlonlinebefragung_domain_model_question'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_woehrlonlinebefragung_domain_model_question']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, typ, category, sorting, answer1, nextquestion1, correct1, answer2, nextquestion2, correct2, answer3, nextquestion3, correct3, answer4, nextquestion4, correct4, answer5, nextquestion5, correct5, relation',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, typ, category,sorting,--div--;
		Antwort,requirefeld,prozenterledigt,
		answer1,  correct1, nextquestion1,
		answer2,  correct2, nextquestion2,
		answer3,  correct3, nextquestion3,
		answer4,  correct4, nextquestion4,
		answer5,  correct5, nextquestion5,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_woehrlonlinebefragung_domain_model_question',
				'foreign_table_where' => 'AND tx_woehrlonlinebefragung_domain_model_question.pid=###CURRENT_PID### AND tx_woehrlonlinebefragung_domain_model_question.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'typ' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.typ',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.qtype.I.0', 0),
                    array('LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.qtype.I.1', 1),
                    array('LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.qtype.I.2', 2),
                    array('LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.qtype.I.3', 3),
                    array('LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.qtype.I.4', 4),
                    array('LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.qtype.I.5', 5),
                    array('LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.qtype.I.6', 6),
                    array('LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.qtype.I.7', 7),
				),
				'size' => 1,
				'maxitems' => 1,
                'default' => 1,
			),
		),
        'category' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.category',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_woehrlonlinebefragung_domain_model_category',
                'foreign_table_where' => 'AND tx_woehrlonlinebefragung_domain_model_category.pid=###CURRENT_PID### ORDER BY tx_woehrlonlinebefragung_domain_model_category.uid',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
		'answer1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.answer1',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'nextquestion1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.nextquestion1',
			'config' => array(
				'type' => 'select',
                'items' => array(
                    array('--------', 0),
                ),
                'foreign_table' => 'tx_woehrlonlinebefragung_domain_model_question',
				'size' => 1,
				'maxitems' => 1,
                'maxitems' => 1,
			),
		),
		'correct1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.correct1',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'answer2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.answer2',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
        'nextquestion2' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.nextquestion2',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('--------', 0),
                ),
                'foreign_table' => 'tx_woehrlonlinebefragung_domain_model_question',
                'size' => 1,
                'maxitems' => 1,
                'maxitems' => 1,
            ),
        ),
		'correct2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.correct2',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'answer3' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.answer3',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
        'nextquestion3' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.nextquestion3',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('--------', 0),
                ),
                'foreign_table' => 'tx_woehrlonlinebefragung_domain_model_question',
                'size' => 1,
                'maxitems' => 1,
                'maxitems' => 1,
            ),
        ),
		'correct3' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.correct3',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'answer4' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.answer4',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
        'nextquestion4' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.nextquestion4',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('--------', 0),
                ),
                'foreign_table' => 'tx_woehrlonlinebefragung_domain_model_question',
                'size' => 1,
                'maxitems' => 1,
                'maxitems' => 1,
            ),
        ),
		'correct4' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.correct4',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'answer5' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.answer5',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
        'nextquestion5' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.nextquestion5',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('--------', 0),
                ),
                'foreign_table' => 'tx_woehrlonlinebefragung_domain_model_question',
                'size' => 1,
                'maxitems' => 1,
                'maxitems' => 1,
            ),
        ),
		'correct5' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.correct5',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'relation' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.relation',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlonlinebefragung_domain_model_relation',
				'MM' => 'tx_woehrlonlinebefragung_question_relation_mm',
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
							'table' => 'tx_woehrlonlinebefragung_domain_model_relation',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
        'sorting' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_onlinebefragung/Resources/Private/Language/locallang_db.xlf:tx_woehrlonlinebefragung_domain_model_question.sorting',
            'config' => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ),
        ),
		'prozenterledigt' => array(
			'exclude' => 1,
			'label' => 'Erledigt',
			'config' => array(
				'type' => 'input',
				'size' => 4,
			),
		),

		'requirefeld' => array(
			'exclude' => 1,
			'label' => 'Require',
			'config' => array(
				'type' => 'check',
			),
		),


		
	),
);
