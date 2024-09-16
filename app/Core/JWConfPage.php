<?php

declare(strict_types=1);

namespace App\Core;

use Illuminate\Support\Facades\Cache;

class JWConfPage
{
    public static function getHTML()
    {
        return Cache::remember('cachepage', now()->addDay(), function () {
            return (new self)->downloadPage();
        });
    }

    private function downloadPage()
    {
        $content = file_get_contents(config('radiosendungen.site_url'));
        return $content;
    }
}
