<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WOEHRL.' . $_EXTKEY,
	'Pi1',
	array(
		'Stylecardantrag' => 'form, subscribe',
		
	),
	// non-cacheable actions
	array(
		'Stylecardantrag' => 'form, subscribe',
		
	)
);


