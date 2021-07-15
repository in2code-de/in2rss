<?php
defined('TYPO3_MODE') or die('Access denied.');

// you can exclude some fields form backend-rendering - it have nothing to do with your extension
// $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['in2rss_main']='layout,select_key,pages';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['in2rss_main'] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'in2rss_main',
    'FILE:EXT:in2rss/Configuration/FlexForm/Main.xml'
);
