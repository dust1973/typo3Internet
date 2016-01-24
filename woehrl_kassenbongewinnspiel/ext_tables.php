<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'WÖHRL Kassenbon - Gewinnspiel'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'WÖHRL KASSENBON-GEWINNSPIEL');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer', 'EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_csh_tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer');
$GLOBALS['TCA']['tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_kassenbongewinnspiel/Resources/Private/Language/locallang_db.xlf:tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer',
		'label' => 'gender',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'gender,firstname,lastname,title,email,zip,city,address,description,werbung,filiale,kasse,bon,bondatum,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Teilnehmer.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlkassenbongewinnspiel_domain_model_teilnehmer.gif'
	),
);
