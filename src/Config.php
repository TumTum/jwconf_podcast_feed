<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 11:00
 */

namespace tm\rss;

/**
 * Class Config
 * @package tm\rss
 */
class Config
{
    /**
     * An diesen tagen wird Kontrolliert ob neue Sendungen da sind
     *
     * @var string[]
     */
    public static $events = [
        '12.07.2020',
        '16.08.2020',
        '13.09.2020',
        '25.10.2020',
        '15.11.2020',
        '20.12.2020',
    ];

    /**
     * Der download host.
     *
     * @var string
     */
    public static $jwconf_host = "https://jwconf.org/";

    /**
     * Auf dieser Seite sind alle MP3 gelistet
     *
     * @var string
     */
    public static $jwconf_url = "https://jwconf.org/sendungen/";

    /**
     * Spcher ort der Datenbank
     *
     * @var string
     */
    public static $database_path = __DIR__ . '/../var/feeddb.sqlite3.db';

}
