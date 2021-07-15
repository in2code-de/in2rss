<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        /**
         * Configure Plugin
         */
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2rss',
            'Main',
            [
                \In2code\In2rss\Controller\RssController::class => 'index',
            ]
        );

        /**
         * Caching Configuration
         */
        if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds'])) {
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds'] = [];
        }
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds'] = array_merge(
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds'],
            [
                'groups' => [
                    'pages',
                    'all'
                ],
                'options' => [
                    'defaultLifetime' => 300
                ],
            ]
        );
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['in2rss_feeds']['options'] = [
            'defaultLifetime' => 300
        ];
    }
);
