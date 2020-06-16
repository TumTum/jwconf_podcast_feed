<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 11:19
 */

namespace tm\rss;

require __DIR__ . '/../vendor/autoload.php';

$today = date_create('now')->format('d.m.Y');

if (array_search($today, Config::$events) !== false || Config::isDevMode()) {
    (new \tm\rss\Crawler())->run();
}
