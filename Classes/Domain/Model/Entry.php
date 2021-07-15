<?php
namespace In2code\In2rss\Domain\Model;

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

use In2code\In2rss\Utility\HtmlUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
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
     * @param \SimpleXMLElement $item
     * @return Entry
     */
    public function __construct(\SimpleXMLElement $item = null)
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
     */
    public function setPubDate($pubDate)
    {
        $pubDate = new \DateTime($pubDate);
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
     *
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
