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
        '10.01.2021', # offizell
        '11.01.2021',
        '12.01.2021',
        '13.01.2021',

        '15.02.2021',
        '28.02.2021',

        '15.03.2021',
        '28.03.2021',

        '15.04.2021',
        '28.04.2021',

        '15.05.2021',
        '28.05.2021',

        '15.06.2021',
        '28.06.2021',

        '15.07.2021',
        '28.07.2021',

        '15.08.2021',
        '28.08.2021',

        '15.09.2021',
        '28.09.2021',

        '15.10.2021',
        '28.10.2021',

        '15.11.2021',
        '28.11.2021',

        '15.12.2021',
        '28.12.2021',
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

    /**
     * prüft in der Datei /var/.env nach devMode = true;
     * @return bool
     */
    public static function isDevMode()
    {
        $fileInfo = new \SplFileInfo(__DIR__ . '/../var/.env');

        if ($fileInfo->isFile()) {
            $ini_file = parse_ini_file($fileInfo->getPathname());
            return isset($ini_file['devMode']) && $ini_file['devMode'] == true;
        }

        return false;
    }
}
