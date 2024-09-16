<?php

namespace App\Http\Controllers;

use App\Models\Sendung;
use App\Service\RssEpisodeService;
use MarcW\RssWriter\Extension\Atom\AtomWriter;
use MarcW\RssWriter\Extension\Core\Channel;
use MarcW\RssWriter\Extension\Core\CoreWriter;
use MarcW\RssWriter\Extension\Core\Image;
use MarcW\RssWriter\Extension\DublinCore\DublinCoreWriter;
use MarcW\RssWriter\Extension\Itunes\ItunesWriter;
use MarcW\RssWriter\Extension\Slash\SlashWriter;
use MarcW\RssWriter\Extension\Sy\Sy;
use MarcW\RssWriter\Extension\Sy\SyWriter;
use MarcW\RssWriter\RssWriter;

class FeedController extends Controller
{
    public function feed(RssEpisodeService $episodeService)
    {
        date_default_timezone_set('UTC');

        $rssWriter = new RssWriter(null, [], true);
        $rssWriter->registerWriter(new CoreWriter());
        $rssWriter->registerWriter(new ItunesWriter());
        $rssWriter->registerWriter(new SyWriter());
        $rssWriter->registerWriter(new SlashWriter());
        $rssWriter->registerWriter(new AtomWriter());
        $rssWriter->registerWriter(new DublinCoreWriter());

        $channel = new Channel();

        $image = new Image();
        $image->setUrl(url('/storage/jz-sendung-icon.png'))
            ->setTitle('JZ Sendungen')
            ->setLink(url('https://sendungen.jwconf.org/'))
            ->setWidth(350)
            ->setHeight(350)
        ;

        $lastBuildDate = $pubDate = Sendung::latest('updated_at')->first()?->updated_at ?? now();

        $channel->setTitle('JZ - Radiosendungen')
            ->setLink(url('/'))
            ->setDescription('Monatliche Radiosendungen von Jehovas Zeugen')
            ->setLanguage('de')
            ->setWebMaster('developer@tobimat.eu')
            ->setPubDate($pubDate)
            ->setLastBuildDate($lastBuildDate)
            ->setDocs('https://www.rssboard.org/rss-specification')
            ->setGenerator('Generator v1')
            ->setTtl(60 * 1 * 24 * 7) // 7 Tage
            ->setImage($image)
            ->setRating('R')
        ;

        $channel->addExtension((new Sy())->setUpdatePeriod(Sy::PERIOD_MONTHLY));

        $episodeService->addEpisodes($channel);

        return response($rssWriter->writeChannel($channel), 200)
            ->header('Content-Type', 'application/rss+xml');
    }
}
