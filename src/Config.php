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
        '07.01.2024', # Offical
        '16.01.2024',
        '17.01.2024',

        '04.02.2024', # Offical
        '05.02.2024',
        '06.02.2024',
        '07.02.2024',

        '10.03.2024', # Offical
        '11.03.2024',
        '12.03.2024',
        '13.03.2024',

        '14.04.2024', # Offical
        '15.04.2024',
        '16.04.2024',
        '17.04.2024',

        '02.06.2024', # Offical
        '03.06.2024',
        '04.06.2024',
        '05.06.2024',

        '30.06.2024', # Offical
        '01.07.2024',
        '02.07.2024',
        '03.07.2024',

        '21.07.2024', # Offical
        '22.07.2024',
        '23.07.2024',
        '24.07.2024',

        '18.08.2024', # Offical
        '19.08.2024',
        '20.08.2024',
        '21.08.2024',

        '22.09.2024', # Offical
        '23.09.2024',
        '24.09.2024',
        '25.09.2024',

        '03.11.2024', # Offical
        '04.11.2024',
        '05.11.2024',
        '06.11.2024',

        '01.12.2024', # Offical
        '02.12.2024',
        '03.12.2024',
        '04.12.2024',

        '29.12.2024', # Offical
        '30.12.2024',
        '31.12.2024',
        '01.01.2025',

        '14.04.2024', # Offical
        '15.04.2024',
        '16.04.2024',
        '17.04.2024',

        '13.10.2024', # Offical
        '14.10.2024',
        '15.10.2024',
        '16.10.2024',
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
