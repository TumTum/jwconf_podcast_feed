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
        '02.01.2022', # Offical
        '03.01.2022',
        '04.01.2022',
        '05.01.2022',

        '06.02.2022', # Offical
        '07.02.2022',
        '08.02.2022',
        '09.02.2022',

        '06.03.2022', # Offical
        '07.03.2022',
        '08.03.2022',
        '09.03.2022',

        '03.04.2022', # Offical
        '04.04.2022',
        '05.04.2022',
        '06.04.2022',

        '24.04.2022', # Offical
        '25.04.2022',
        '26.04.2022',
        '27.04.2022',

        '08.05.2022', # Offical
        '09.05.2022',
        '10.05.2022',
        '11.05.2022',

        '12.06.2022', # Offical
        '13.06.2022',
        '14.06.2022',
        '15.06.2022',

        '10.07.2022', # Offical
        '11.07.2022',
        '12.07.2022',
        '13.07.2022',

        '07.08.2022', # Offical
        '08.08.2022',
        '09.08.2022',
        '10.08.2022',

        '04.09.2022', # Offical
        '05.09.2022',
        '06.09.2022',
        '07.09.2022',

        '25.09.2022', # Offical
        '26.09.2022',
        '27.09.2022',
        '28.09.2022',

        '09.10.2022', # Offical
        '10.10.2022',
        '11.10.2022',
        '12.10.2022',

        '06.11.2022', # Offical
        '07.11.2022',
        '08.11.2022',
        '09.11.2022',

        '04.12.2022', # Offical
        '05.12.2022',
        '06.12.2022',
        '07.12.2022',
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
