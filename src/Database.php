<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 10:59
 */

namespace tm\rss;

use tm\rss\model\Sendung;

/**
 * Class Database
 * @package tm\rss
 */
class Database
{
    /**
     * @var \Ark\Database\Connection
     */
    protected $db;

    public function __construct()
    {
        $this->db = (new InitDatabase())->init();
    }

    /**
     * @return \Ark\Database\Connection
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return array
     */
    public function getSendungen()
    {
        return $this->db->factory(Sendung::class)->findAll();
    }

    /**
     * @return \Ark\Database\Model|Sendung
     */
    public function getSendung()
    {
        return $this->db->factory(Sendung::class)->create();
    }
}
