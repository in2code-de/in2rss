<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
defined('TYPO3_MODE') || die('Access denied.');

/**
 * Hide unneeded fields
 */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['in2rss_main']
    ='pages,recursive';

/**
 * Add FlexForm
 */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['in2rss_main'] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    'in2rss_main',
    'FILE:EXT:in2rss/Configuration/FlexForm/Main.xml'
);
