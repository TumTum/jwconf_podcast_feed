<?php

declare(strict_types=1);

namespace App\Core;

use App\DAO\SendungData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class MediaData
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function fetchLengthAndType(SendungData $sendungData): void
    {
        list($length, $type) = self::cachedFetchMediaData($sendungData);

        $sendungData
            ->setLength($length)
            ->setType($type);
    }

    private static function cachedFetchMediaData($sendungData): array
    {
        $key = 'media' . md5($sendungData->getHref());
        return Cache::remember($key, 86400, function () use ($sendungData) {
            return self::fetchMediaData($sendungData);
        });
    }

    private static function fetchMediaData(SendungData $sendungData): array
    {
        try {
            $client = new Client(['base_uri' => config('radiosendungen.site_url')]);
            $res = $client->request(
                'HEAD',
                $sendungData->getHref(),
                [
                    'headers' => [
                        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36'
                    ]
                ]
            );

            $length = (integer)$res->getHeaderLine('Content-Length') ?: 0;
            $type = $res->getHeaderLine('Content-Type') ?: 'audio/mpeg';
        } catch (GuzzleException $e) {
            fwrite(STDERR, $e->getMessage() . PHP_EOL);

            $length = 0;
            $type = 'audio/mpeg';
        }

        return [$length, $type];
    }
}
