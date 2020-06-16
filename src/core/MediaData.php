<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 16.06.20
 * Time: 07:23
 */

namespace tm\rss\core;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use tm\rss\Config;
use tm\rss\dao\SendungData;

/**
 * Class MediaData
 * @package tm\rss\core
 */
class MediaData
{
    private $sendungData;

    /**
     * MediaData constructor.
     */
    public function __construct(SendungData $sendungData)
    {
        $this->sendungData = $sendungData;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetch()
    {
        try {
            $client = new Client(['base_uri' => Config::$jwconf_host]);
            $res = $client->request(
                'HEAD',
                $this->sendungData->getHref(),
                [
                    'headers' => [
                        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36'
                    ]
                ]
            );

            $length = $res->getHeaderLine('Content-Length') ? : 0;
            $type = $res->getHeaderLine('Content-Type') ? : 'audio/mpeg';
        } catch (GuzzleException $e) {
            fwrite(STDERR,  $e->getMessage() . PHP_EOL);

            $length =  0;
            $type = 'audio/mpeg';
        }

        $this->sendungData
            ->setLength($length)
            ->setType($type);
    }
}
