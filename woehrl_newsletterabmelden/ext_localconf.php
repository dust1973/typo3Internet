<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WOEHRL.' . $_EXTKEY,
	'Pi1',
	array(
		'Newsletter' => 'unsubscribe',
		
	),
	// non-cacheable actions
	array(
		'Newsletter' => 'unsubscribe',

	)
);
