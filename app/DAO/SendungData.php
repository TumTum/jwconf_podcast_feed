<?php

declare(strict_types=1);

namespace App\DAO;

use DateTimeZone;

class SendungData
{
    private string $pubdate;

    private string $thema;

    private string $sender;

    private string $url;

    private string $href;

    private int $length;

    private string $type;

    public function getPubdate(): \DateTime
    {

        return date_create_from_format('d.m.Y H:i:s', $this->pubdate . ' 00:00:00', new DateTimeZone('UTC'));
    }

    public function setPubdate(string $pubdate): SendungData
    {
        $this->pubdate = $pubdate;
        return $this;
    }

    public function getThema(): string
    {
        return $this->thema;
    }

    public function setThema(string $thema): SendungData
    {
        $this->thema = $thema;
        return $this;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function setSender(string $sender): SendungData
    {
        $this->sender = $sender;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): SendungData
    {
        $this->url = $url;
        return $this;
    }

    public function getHref(): string
    {
        return $this->href;
    }

    public function setHref(string $href): SendungData
    {
        $this->href = $href;
        $this->setUrl(config('radiosendungen.site_url') . ltrim($href, '/'));

        return $this;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): SendungData
    {
        $this->length = $length;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): SendungData
    {
        $this->type = $type;
        return $this;
    }

    public function getChecksum(): string
    {
        return md5($this->getUrl() . $this->getPubdate()->getTimestamp() . $this->getThema() . $this->getSender());
    }
}
