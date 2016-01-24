<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WOEHRL.' . $_EXTKEY,
	'Pi1',
	array(
		'Gewinnspiel' => 'list',
		'Teilnehmer' => 'new, create, update',
		
	),
	// non-cacheable actions
	array(
		'Teilnehmer' => 'create, update, delete',
		'Gewinnspiel' => 'create, update, delete',
		
	)
);
