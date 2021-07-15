<?php
defined('TYPO3_MODE') or die('Access denied.');

/**
 * Static Template
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript',
    'In2rss: Main Settings'
);

/**
 * Register Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'In2code.' . $_EXTKEY,
    'Main',
    'In2rss: Display RSS Feed'
);