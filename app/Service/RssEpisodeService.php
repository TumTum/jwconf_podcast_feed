<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Sendung;
use MarcW\RssWriter\Extension\Core\Channel;
use MarcW\RssWriter\Extension\Core\Enclosure;
use MarcW\RssWriter\Extension\Core\Guid;
use MarcW\RssWriter\Extension\Core\Item;
use MarcW\RssWriter\Extension\Core\Source;

class RssEpisodeService
{
    public function addEpisodes(Channel $channel)
    {
        $episodes = Sendung::all();

        $source = new Source();
        $source->setUrl($channel->getLink())->setTitle('Monatliche Radiosendungen von Jehovas Zeugen');

        foreach ($episodes as $episode) {

            $enclosure = new Enclosure();
            $enclosure->setUrl($episode->getUrl())
                ->setLength($episode->getLength())
                ->setType($episode->getType());


            $item = new Item();
            $item->setTitle($episode->getThema())
                ->setDescription($episode->getDescription())
                ->setLink($episode->getUrl())
                ->setAuthor($episode->getSender())
                ->setEnclosure($enclosure)
                ->setPubDate($episode->getPubdate())
                ->setSource($source)
                ->setGuid((new Guid())->setIsPermaLink(false)->setGuid('tag:jz:'.$episode->getChecksum().':radio'));

            $channel->addItem($item);
        }
    }
}
