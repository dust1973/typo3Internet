<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WOEHRL.' . $_EXTKEY,
	'Pi1',
	array(
		'Teilnehmer' => 'new, list, show, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Teilnehmer' => 'create, update, delete',
		
	)
);
