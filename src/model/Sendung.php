<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 11:06
 */

namespace tm\rss\model;

use Ark\Database\Model;

class Sendung extends Model
{
    public static $schema = "
        CREATE TABLE IF NOT EXISTS sendungen (
                id INTEGER PRIMARY KEY,
                checksum VARCHAR(32),
                pubdate DATE, 
                thema VARCHAR(255),
                sender VARCHAR(255),
                url TEXT,
                type VARCHAR(15),
                length INTEGER
    )";

    public static function config()
    {
        return [
            'table' => 'sendungen',
            'pk' => 'id'
        ];
    }

    /**
     * @return string
     */
    public function getChecksum()
    {
        return $this->get('checksum');
    }

    /**
     * @param $data
     * @return $this
     */
    public function setChecksum($data)
    {
        $this->set('checksum', $data);
        return $this;
    }

    /**
     * @return string
     */
    public function getPubdate()
    {
        return $this->get('pubdate');
    }

    /**
     * @param $data
     * @return $this
     */
    public function setPubdate($data)
    {
        $this->set('pubdate', $data);
        return $this;
    }

    /**
     * @return string
     */
    public function getThema()
    {
        return $this->get('thema');
    }

    /**
     * @param $data
     * @return $this
     */
    public function setThema($data)
    {
        $this->set('thema', $data);
        return $this;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->get('sender');
    }

    /**
     * @param $data
     * @return $this
     */
    public function setSender($data)
    {
        $this->set('sender', $data);
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->get('url');
    }

    /**
     * @param $data
     * @return $this
     */
    public function setUrl($data)
    {
        $this->set('url', $data);
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->get('type');
    }

    /**
     * @param $data
     * @return $this
     */
    public function setType($data)
    {
        $this->set('type', $data);
        return $this;
    }

    /**
     * @return string
     */
    public function getLength()
    {
        return $this->get('length');
    }

    /**
     * @param $data
     * @return $this
     */
    public function setLength($data)
    {
        $this->set('length', $data);
        return $this;
    }
}
