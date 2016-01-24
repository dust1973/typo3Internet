<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'WÖHRL Gewinnspiele'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'WÖHRL Gewinnspiele');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlgewinnspiele_domain_model_teilnehmer', 'EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_csh_tx_woehrlgewinnspiele_domain_model_teilnehmer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlgewinnspiele_domain_model_teilnehmer');
$GLOBALS['TCA']['tx_woehrlgewinnspiele_domain_model_teilnehmer'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_teilnehmer',
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
		'searchFields' => 'gender,firstname,lastname,title,email,phone,mobile,zip,city,address,description,werbung,country,filiale,kasse,bon,bondatum,gewinnspiel,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Teilnehmer.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlgewinnspiele_domain_model_teilnehmer.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlgewinnspiele_domain_model_gewinnspiel', 'EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_csh_tx_woehrlgewinnspiele_domain_model_gewinnspiel.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlgewinnspiele_domain_model_gewinnspiel');
$GLOBALS['TCA']['tx_woehrlgewinnspiele_domain_model_gewinnspiel'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_gewinnspiele/Resources/Private/Language/locallang_db.xlf:tx_woehrlgewinnspiele_domain_model_gewinnspiel',
		'label' => 'title',
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
		'searchFields' => 'title,subtitle,gewinnspieldatetimestart,gewinnspieldatetimestop,teasertext,teilnahmebedingungen,vorschaubild,titlebild,kassenbonn,description,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Gewinnspiel.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlgewinnspiele_domain_model_gewinnspiel.gif'
	),
);
