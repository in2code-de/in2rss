<?php
defined('TYPO3_MODE') || die('Access denied.');


call_user_func(
    function () {
        /**
         * Static Template
         */
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
            'in2rss',
            'Configuration/TypoScript',
            'In2rss: Main Settings'
        );

        /**
         * Register Plugin
         */
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'In2rss',
            'Main',
            'In2rss: Display RSS Feed'
        );
    }
);
