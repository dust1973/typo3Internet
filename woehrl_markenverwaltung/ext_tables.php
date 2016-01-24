<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'WÖHRL Markenverwaltung'
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'WÖHRL Markenverwaltung');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlmarkenverwaltung_domain_model_marke', 'EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_csh_tx_woehrlmarkenverwaltung_domain_model_marke.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlmarkenverwaltung_domain_model_marke');
$GLOBALS['TCA']['tx_woehrlmarkenverwaltung_domain_model_marke'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_db.xlf:tx_woehrlmarkenverwaltung_domain_model_marke',
		'label' => 'marke',
		'label_alt' => 'categorys',
		'label_alt_force' => 1,
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
		'searchFields' => 'marke,markelink,categorys,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Marke.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlmarkenverwaltung_domain_model_marke.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlmarkenverwaltung_domain_model_category', 'EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_csh_tx_woehrlmarkenverwaltung_domain_model_category.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlmarkenverwaltung_domain_model_category');
$GLOBALS['TCA']['tx_woehrlmarkenverwaltung_domain_model_category'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_db.xlf:tx_woehrlmarkenverwaltung_domain_model_category',
		'label' => 'kategoriename',
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
		'searchFields' => 'kategoriename,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlmarkenverwaltung_domain_model_category.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlmarkenverwaltung_domain_model_modehaus', 'EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_csh_tx_woehrlmarkenverwaltung_domain_model_modehaus.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlmarkenverwaltung_domain_model_modehaus');
$GLOBALS['TCA']['tx_woehrlmarkenverwaltung_domain_model_modehaus'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_markenverwaltung/Resources/Private/Language/locallang_db.xlf:tx_woehrlmarkenverwaltung_domain_model_modehaus',
		'label' => 'haus',
		'label_alt' => 'hausnummer',
		'label_alt_force' => 1,
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
		'searchFields' => 'haus,hausnummer,categorys,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Modehaus.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlmarkenverwaltung_domain_model_modehaus.gif'
	),
);
