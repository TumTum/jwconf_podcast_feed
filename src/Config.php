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
        '08.01.2023', # Offical
        '09.01.2023',
        '10.01.2023',
        '11.01.2023',

        '05.02.2023', # Offical
        '06.02.2023',
        '07.02.2023',
        '08.02.2023',

        '05.03.2023', # Offical
        '06.03.2023',
        '07.03.2023',
        '08.03.2023',

        '16.04.2023', # Offical
        '17.04.2023',
        '18.04.2023',
        '19.04.2023',

        '23.04.2023', # Offical
        '24.04.2023',
        '25.04.2023',
        '26.04.2023',

        '07.05.2023', # Offical
        '08.05.2023',
        '09.05.2023',
        '10.05.2023',

        '11.06.2023', # Offical
        '12.06.2023',
        '13.06.2023',
        '14.06.2023',

        '09.07 2023', # Offical
        '10.07 2023',
        '11.07 2023',
        '12.07 2023',

        '13.08.2023', # Offical
        '14.08.2023',
        '15.08.2023',
        '16.08.2023',

        '03.09.2023', # Offical
        '04.09.2023',
        '05.09.2023',
        '06.09.2023',

        '24.09.2023', # Offical
        '25.09.2023',
        '26.09.2023',
        '27.09.2023',

        '08.10.2023', # Offical
        '09.10.2023',
        '10.10.2023',
        '11.10.2023',

        '12.11.2023', # Offical
        '13.11.2023',
        '14.11.2023',
        '15.11.2023',

        '10.12.2023', # Offical
        '11.12.2023',
        '12.12.2023',
        '13.12.2023',
    ];

    /**
     * Der download host.
     *
     * @var string
     */
    public static $jwconf_host = "https://sendungen.jwconf.org/";

    /**
     * Auf dieser Seite sind alle MP3 gelistet
     *
     * @var string
     */
    public static $jwconf_url = "https://sendungen.jwconf.org/";

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
