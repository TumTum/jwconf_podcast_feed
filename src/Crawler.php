<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 10:56
 */

namespace tm\rss;

use tm\rss\core\MediaData;
use tm\rss\dao\SendungData;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class Crawler
{
    private $db;

    /**
     * Crawler constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    public function run()
    {
        $htmlPageCrawler = HtmlPageCrawler::create((new JWConfPage())->getHTML());
        $htmlPageCrawler->filter("table > tbody > tr")->each(function (HtmlPageCrawler $dom, $index) {
            $this->addSendung($dom);
            print '.';
        });
    }

    protected function addSendung($dom)
    {
        $sendungData = new SendungData();

        $dom->filter('td')->each(function (HtmlPageCrawler $dom, $index) use ($sendungData) {
            $column = [
                'getDomPubdate',
                'getDomThema',
                'getDomSender',
            ];
            call_user_func_array([$this, $column[$index]], [$dom, $sendungData]);
        });

        $isExitsDb = $this->db->findSendung($sendungData->getChecksum());
        if ($isExitsDb === false) {
            $this->addToDb($sendungData);
        }
    }

    protected function getDomPubdate(HtmlPageCrawler $dom, SendungData $sendungData)
    {
        $date = $dom->getInnerHtml();
        $sendungData->setPubdate($date);
    }

    protected function getDomThema(HtmlPageCrawler $dom, SendungData $sendungData)
    {
        $mediaLink = $dom->filter('a');

        $sendungData->setThema($mediaLink->getInnerHtml());
        $sendungData->setHref($mediaLink->attr('href'));
    }

    protected function getDomSender(HtmlPageCrawler $dom, SendungData $sendungData)
    {
        $sendungData->setSender($dom->getInnerHtml());
    }

    /**
     * @param SendungData $sendungData
     */
    protected function addToDb(SendungData $sendungData)
    {
        (new MediaData($sendungData))->fetch();

        $this->db->getSendung()
            ->setPubdate($sendungData->getPubdate())
            ->setThema($sendungData->getThema())
            ->setSender($sendungData->getSender())
            ->setUrl($sendungData->getUrl())
            ->setLength($sendungData->getLength())
            ->setType($sendungData->getType())
            ->setChecksum($sendungData->getChecksum())
            ->save();
    }
}
