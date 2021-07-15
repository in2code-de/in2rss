<?php
defined('TYPO3_MODE') or die('Access denied.');

/**
 * Configure Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'In2code.' . $_EXTKEY,
    'Main',
    array(
        'Rss' => 'index',
    ),
    // non-cacheable actions
    array()
);

/**
 * Caching Configuration
 */
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds'] = array();
}
$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds'] = array_merge(
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds'],
    array(
        'groups' => array(
            'pages',
            'all'
        ),
        'options' => array(
            'defaultLifetime' => 300
        ),
    )
);
$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds']['options'] = array(
    'defaultLifetime' => 300
);
