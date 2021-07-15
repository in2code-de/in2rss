<?php
namespace In2code\In2rss\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Dominique Kreemers <dominique.kreemers@in2code.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use In2code\In2rss\Domain\Model\Entry;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * RssService
 */
class RssService implements SingletonInterface
{
    /**
     * @var FrontendInterface
     */
    protected $cache;

    /**
     * Contains the settings of the current extension
     *
     * @var array
     * @api
     */
    protected $settings;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @param ConfigurationManagerInterface $configurationManager
     * @param CacheManager $cacheManager
     * @return RssService
     */
    public function __construct(ConfigurationManagerInterface $configurationManager, CacheManager $cacheManager)
    {
        $this->configurationManager = $configurationManager;
        $this->settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
        $this->cache = $cacheManager->getCache('in2rss_feeds');
    }

    /**
     * @param string $url
     * @param int $limit
     * @return array
     */
    public function getFeed($url, $limit = 0)
    {
        $cacheHash = sha1(serialize(array(
            $url,
            $limit
        )));
        if (!$this->cache->has($cacheHash) || $this->settings['enableCache'] == 0) {
            $feedData = GeneralUtility::getUrl($url);
            if ($feedData === false) {
                throw new \RuntimeException(
                    'Could not connect to ' . $url . '. Check your proxy or firewall settings.',
                    1516887801
                );
            }
            if (strlen($feedData)) {
                $xml = new \SimpleXmlElement($feedData);

                $entries = array();
                foreach ($xml->channel->item as $entry) {
                    /* @var $entry \SimpleXMLElement */
                    $entryObject = new Entry($entry);
                    $entries[] = $entryObject;
                    if ($limit > 0 && count($entries) >= $limit) {
                        break;
                    }
                }
                $this->cache->set($cacheHash, $entries);
            }
        } else {
            $entries = $this->cache->get($cacheHash);
        }
        return $entries;
    }
}
