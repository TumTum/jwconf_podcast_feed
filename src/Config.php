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

        '07.02.2021', # offizell
        '08.02.2021',
        '09.02.2021',
        '10.02.2021',

        '07.03.2021', # offizell
        '08.03.2021',
        '09.03.2021',
        '10.03.2021',

        '11.04.2021', # offizell
        '12.04.2021',
        '13.04.2021',
        '14.04.2021',

        '16.05.2021', # offizell
        '17.05.2021',
        '18.05.2021',
        '19.05.2021',

        '20.06.2021', # offizell
        '21.06.2021',
        '22.06.2021',
        '23.06.2021',

        '18.07.2021', # offizell
        '19.07.2021',
        '20.07.2021',
        '21.07.2021',

        '15.08.2021', # offizell
        '16.08.2021',
        '17.08.2021',
        '18.08.2021',

        '19.09.2021', # offizell
        '20.09.2021',
        '21.09.2021',
        '22.09.2021',

        '17.10.2021', # offizell
        '18.10.2021',
        '19.10.2021',
        '20.10.2021',

        '21.11.2021', # offizell
        '22.11.2021',
        '23.11.2021',
        '24.11.2021',

        '19.12.2021', # offizell
        '20.12.2021',
        '21.12.2021',
        '22.12.2021',

        '18.04.2021', # offizell
        '19.04.2021',
        '20.04.2021',
        '21.04.2021',

        '26.09.2021', # offizell
        '27.09.2021',
        '28.09.2021',
        '29.09.2021',
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
