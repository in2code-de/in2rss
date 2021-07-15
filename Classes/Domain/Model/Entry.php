<?php
namespace In2code\In2rss\Domain\Model;

use DateTime;
use Exception;
use In2code\In2rss\Utility\HtmlUtility;
use SimpleXMLElement;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Entry Model
 */
class Entry extends AbstractEntity
{
    /**
     * @var string
     */
    protected $link;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $pubDate;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $enclosure;

    /**
     * @param SimpleXMLElement $item
     * @return Entry
     */
    public function __construct(SimpleXMLElement $item)
    {
        $this->setLink($item->link->__toString());
        $this->setTitle($item->title->__toString());
        $this->setPubDate($item->pubDate->__toString());
        $this->setDescription($item->description->__toString());
        $this->setEnclosure($item->enclosure->attributes()->url->__toString());
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * @param string $pubDate
     * @throws Exception
     */
    public function setPubDate($pubDate)
    {
        $pubDate = new DateTime($pubDate);
        $this->pubDate = $pubDate;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $description = HtmlUtility::cleanUpHtml($description);
        $this->description = $description;
    }

    /**
     * @return void
     */
    protected function cleanUpHtml()
    {
    }

    /**
     * @return string
     */
    public function getEnclosure()
    {
        return $this->enclosure;
    }

    /**
     * @param string $enclosure
     */
    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;
    }
}
