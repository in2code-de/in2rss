<?php
namespace In2code\In2rss\Controller;

use In2code\In2rss\Service\RssService;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * RssController
 */
class RssController extends ActionController
{
    /**
     * @var RssService
     */
    protected $rssService;

    /**
     * @param RssService $rssService
     */
    public function __construct(RssService $rssService)
    {
        $this->rssService = $rssService;
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $entries = $this->rssService->getFeed(
            $this->settings['feedUrl'],
            $this->settings['limit']
        );
        $this->view->assign('entries', $entries);
    }
}
