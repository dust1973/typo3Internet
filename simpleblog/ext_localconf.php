<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Typovision.' . $_EXTKEY,
	'Bloglisting',
	array(
		'Blog' => 'list, addForm, add, show, updateForm, update, deleteConfirm, delete',
		'Post' => 'addForm, add, show, updateForm, update, deleteConfirm, delete, ajax',
	),
	// non-cacheable actions
	array(
		'Blog' => 'list, addForm, add, show, updateForm, update, deleteConfirm, delete',
		'Post' => 'addForm, add, show, updateForm, update, deleteConfirm, delete, ajax',
	)
);

$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
	'TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher'
);

$signalSlotDispatcher->connect(
	'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Backend',
	'afterInsertObject',
	'Typovision\\Simpleblog\\Service\\SignalService',
	'handleInsertEvent'
);

$signalSlotDispatcher->connect(
	'Typovision\\Simpleblog\\Controller\\PostController',
	'beforeCommentCreation',
	'Typovision\\Simpleblog\\Service\\SignalService',
	'handleCommentInsertion'
);
?>