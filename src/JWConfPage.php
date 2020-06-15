<?php
/**
 * Created by jwconfRss.
 * Autor: Tobias Matthaiou <tm@loberon.de>
 * Date: 15.06.20
 * Time: 11:31
 */

namespace tm\rss;


class JWConfPage
{
    public function getHTML()
    {
        $fileInfo = new \SplFileInfo(__DIR__ . '/../var/cachepage.html');
        if ($fileInfo->isFile()) {
            return file_get_contents($fileInfo->getRealPath());
        } else {
            return $this->downloadPage($fileInfo->getPathname());
        }
    }

    protected function downloadPage($path)
    {
        $content = file_get_contents(Config::$jwconf_url);
        file_put_contents($path, $content);
        return $content;
    }
}
