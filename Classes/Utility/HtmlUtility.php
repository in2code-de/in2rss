<?php
namespace In2code\In2rss\Utility;

/**
 * HtmlUtility
 */
class HtmlUtility
{
    /**
     * @param string $html
     * @return string
     */
    public static function cleanUpHtml($html)
    {
        $html = preg_replace('/(\<\/?br.*\/?>)/i', '', $html);
        $html = preg_replace('/(\<\!\-\-.+?\-\-\>)/i', '', $html);
        $html = preg_replace('/(\<\/?a.*?\>)/i', '', $html);
        $html = trim($html);
        return $html;
    }
}
