<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Woehrl.' . $_EXTKEY,
	'Pi2',
	array(
		'Filiale' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Filiale' => 'list, show',
		
	)
);
