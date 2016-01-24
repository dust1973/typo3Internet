<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Woehrl.' . $_EXTKEY,
	'Pi1',
	array(
		'Marke' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Marke' => 'list, show, create, update, delete',
		'Category' => 'list, show, create, update, delete',
		'Modehaus' => 'list, show, create, update, delete',
		
	)
);
