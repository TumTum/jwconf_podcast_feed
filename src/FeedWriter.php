<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 10:22
 */

namespace tm\rss;

use MarcW\RssWriter\Extension\Atom\AtomWriter;
use MarcW\RssWriter\Extension\Core\Channel;
use MarcW\RssWriter\Extension\Core\CoreWriter;
use MarcW\RssWriter\Extension\Core\Enclosure;
use MarcW\RssWriter\Extension\Core\Guid;
use MarcW\RssWriter\Extension\Core\Image;
use MarcW\RssWriter\Extension\Core\Item;
use MarcW\RssWriter\Extension\Core\Source;
use MarcW\RssWriter\Extension\DublinCore\DublinCoreWriter;
use MarcW\RssWriter\Extension\Itunes\ItunesWriter;
use MarcW\RssWriter\Extension\Slash\SlashWriter;
use MarcW\RssWriter\Extension\Sy\Sy;
use MarcW\RssWriter\Extension\Sy\SyWriter;
use MarcW\RssWriter\RssWriter;
use tm\rss\model\Sendung;

class FeedWriter
{
    public function run() {

        $rssWriter = new RssWriter(null, [], true);
        $rssWriter->registerWriter(new CoreWriter());
        $rssWriter->registerWriter(new ItunesWriter());
        $rssWriter->registerWriter(new SyWriter());
        $rssWriter->registerWriter(new SlashWriter());
        $rssWriter->registerWriter(new AtomWriter());
        $rssWriter->registerWriter(new DublinCoreWriter());


        $rssWriter = new RssWriter(null, [], true);
        $rssWriter->registerWriter(new CoreWriter());
        $rssWriter->registerWriter(new ItunesWriter());
        $rssWriter->registerWriter(new SyWriter());
        $rssWriter->registerWriter(new SlashWriter());
        $rssWriter->registerWriter(new AtomWriter());
        $rssWriter->registerWriter(new DublinCoreWriter());

        $source = new Source();
        $source->setUrl('https://sendungen.jwconf.org/')
            ->setTitle('Monatliche Radiosendungen von Jehovas Zeugen');

        $channel = new Channel();

        $image = new Image();
        $image->setUrl('http://podcast.jwconf.oik.gr/jz-sendung-icon.png')
            ->setTitle('JZ Sendungen')
            ->setLink('https://sendungen.jwconf.org/')
            ->setWidth(350)
            ->setHeight(350)
        ;

        $fileInfo = new \SplFileInfo(Config::$database_path);
        $lastBuildDate = $pubDate =  new \DateTime('@'.$fileInfo->getMTime(), new \DateTimeZone('UTC'));

        $channel->setTitle('JZ - Radiosendungen')
            ->setLink('https://podcast.jwconf.oik.gr/')
            ->setDescription('Monatliche Radiosendungen von Jehovas Zeugen')
            ->setLanguage('de')
            ->setWebMaster('developer@tobimat.eu')
            ->setPubDate($pubDate)
            ->setLastBuildDate($lastBuildDate)
            ->setDocs('https://www.rssboard.org/rss-specification')
            ->setGenerator('Generator v1')
            ->setTtl(12 * 60) //12 Stunden
            ->setImage($image)
            ->setRating('R')
        ;

        $channel->addExtension((new Sy())->setUpdatePeriod(Sy::PERIOD_MONTHLY));

        $this->addItems($channel, $source);

        header('Content-Type: application/rss+xml');
        print $rssWriter->writeChannel($channel);
    }

    /**
     * @param Item $item
     * @param \DateTime $pubDate
     * @param Source $source
     * @param Channel $channel
     */
    protected function addItems(Channel $channel, Source $source)
    {
        $sendungen = (new Database())->getSendungen();

        /** @var Sendung $sendung */
        foreach ($sendungen as $sendung) {

            $enclosure = new Enclosure();
            $enclosure->setUrl($sendung->getUrl())
                ->setLength($sendung->getLength())
                ->setType($sendung->getType());


            $pubdate = new \DateTime('@'.$sendung->getPubdate(), new \DateTimeZone('UTC'));

            $item = new Item();
            $item->setTitle($sendung->getThema())
                ->setDescription(sprintf('Radiosendungen wurde am "%s" ausgestrahlt im "%s"', $pubdate->format('d.m.Y'), $sendung->getSender()))
                ->setLink($sendung->getUrl())
                ->setAuthor($sendung->getSender())
                ->setEnclosure($enclosure)
                ->setPubDate($pubdate)
                ->setSource($source)
                ->setGuid((new Guid())->setIsPermaLink(false)->setGuid('tag:jz:'.$sendung->getChecksum().':radio'));

            $channel->addItem($item);
        }
    }
}
