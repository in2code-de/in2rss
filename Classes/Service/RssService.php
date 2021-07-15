<?php

namespace In2code\In2rss\Service;

use In2code\In2rss\Domain\Model\Entry;
use SimpleXmlElement;
use TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException;
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
     * @var array
     * @api
     */
    protected $settings;

    /**
     * @var ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @param ConfigurationManagerInterface $configurationManager
     * @param CacheManager $cacheManager
     * @throws NoSuchCacheException
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
    public function getFeed(string $url, int $limit = 0): array
    {
        $entries = [];
        $cacheHash = sha1(serialize([$url, $limit]));
        if (!$this->cache->has($cacheHash) || $this->settings['enableCache'] == 0) {
            $feedData = GeneralUtility::getUrl($url);
            if ($feedData === false) {
                throw new \RuntimeException(
                    'Could not connect to ' . $url . '. Check your proxy or firewall settings.',
                    1516887801
                );
            }
            if (strlen($feedData)) {
                $xml = new SimpleXmlElement($feedData);
                $entries = [];
                foreach ($xml->channel->item as $entry) {
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
