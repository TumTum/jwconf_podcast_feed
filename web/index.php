<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 10:17
 */

require __DIR__ . '/../vendor/autoload.php';

(new tm\rss\FeedWriter())->run();
