<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WOEHRL.' . $_EXTKEY,
	'Pi1',
	array(
		'Question' => 'list, show, new, create, edit, update, delete',
		'Category' => 'list, show, new, create, edit, update, delete',
		'Relation' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Question' => 'create, update, delete',
		'Category' => 'create, update, delete',
		'Relation' => 'create, update, delete',
		
	)
);
