<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 10:56
 */

namespace tm\rss;


use GuzzleHttp\Client;
use tm\rss\model\Sendung;
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
        $this->db->getSendung()->truncateTable();

        $htmlPageCrawler = HtmlPageCrawler::create((new JWConfPage())->getHTML());
        $htmlPageCrawler->filter("table > tbody > tr")->each(function (HtmlPageCrawler $dom, $index) {
            $this->addSendung($dom);
            print '.';
        });
    }

    protected function addSendung($dom)
    {
        $sendung = $this->db->getSendung();

        $dom->filter('td')->each(function (HtmlPageCrawler $dom, $index) use ($sendung) {
            $column = [
                'getDomPubdate',
                'getDomThema',
                'getDomSender',
            ];
            call_user_func_array([$this, $column[$index]], [$dom, $sendung]);
        });
        $sendung->save();
    }

    protected function getDomPubdate(HtmlPageCrawler $dom, Sendung $sendung)
    {
        $date = $dom->getInnerHtml();
        $dateTime = date_create_from_format('d.m.Y', $date);
        $sendung->setPubdate($dateTime->getTimestamp());
    }

    protected function getDomThema(HtmlPageCrawler $dom, Sendung $sendung)
    {
        $mediaLink = $dom->filter('a');

        $sendung->setThema($mediaLink->getInnerHtml());

        $link = $mediaLink->attr('href');

        $url = Config::$jwconf_host . ltrim($link, '/');
        $sendung->setUrl($url);

        $client = new Client(['base_uri' => Config::$jwconf_host]);
        $res = $client->request(
            'HEAD',
            $link,
            [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36'
                ]
            ]
        );

        $length = $res->getHeaderLine('Content-Length') ? : 0;
        $type = $res->getHeaderLine('Content-Type') ? : 'audio/mpeg';

        $sendung->setLength($length);
        $sendung->setType($type);
    }

    protected function getDomSender(HtmlPageCrawler $dom, Sendung $sendung)
    {
        $sendung->setSender($dom->getInnerHtml());
    }
}
