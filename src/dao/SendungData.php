<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 16.06.20
 * Time: 07:07
 */

namespace tm\rss\dao;

use tm\rss\Config;

/**
 * Class SendungData
 * @package tm\rss\dao
 */
class SendungData
{
    /**
     * @var string
     */
    private $pubdate;

    /**
     * @var string
     */
    private $thema;

    /**
     * @var string
     */
    private $sender;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $href;

    /**
     * @var integer
     */
    private $length;

    /**
     * @var string
     */
    private $type;

    /**
     * @return integer
     */
    public function getPubdate()
    {
        return date_create_from_format('d.m.Y H:i:s', $this->pubdate . ' 00:00:00')->getTimestamp();
    }

    /**
     * @param string $pubdate
     * @return SendungData
     */
    public function setPubdate($pubdate)
    {
        $this->pubdate = $pubdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getThema()
    {
        return $this->thema;
    }

    /**
     * @param string $thema
     * @return SendungData
     */
    public function setThema($thema)
    {
        $this->thema = $thema;
        return $this;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     * @return SendungData
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return SendungData
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return SendungData
     */
    public function setHref($href)
    {
        $this->href = $href;
        $this->setUrl(Config::$jwconf_host . ltrim($href, '/'));

        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return SendungData
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return SendungData
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getChecksum()
    {
        return md5($this->getUrl() . $this->getPubdate() . $this->getThema() . $this->getSender());
    }
}
