<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Netfeld.' . $_EXTKEY,
	'Test',
	array(
		'Client' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Client' => 'create, update, delete',
		
	)
);

?>