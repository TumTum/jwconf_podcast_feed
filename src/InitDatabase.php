<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 10:59
 */

namespace tm\rss;


use tm\rss\model\Sendung;

class InitDatabase
{
    /**
     * @return \Ark\Database\Connection
     */
    public function init()
    {
        $fileInfo = new \SplFileInfo(Config::$database_path);
        if ($fileInfo->isFile() == false) {
            $this->createDatabase();
        }

        return $this->getConnection();
    }

    /**
     * Erstellt die Tabelle noch mal neu
     */
    protected function createDatabase()
    {
        $db = $this->getConnection();
        $db->exec(Sendung::$schema);
    }

    /**
     * @return \Ark\Database\Connection
     */
    protected function getConnection()
    {
        $db = new \Ark\Database\Connection('sqlite:' . Config::$database_path, '', '', ['prefix' => 'jz_']);
        return $db;
    }
}
