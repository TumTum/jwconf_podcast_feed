<?php
namespace Deployer;

require 'recipe/laravel.php';
require_once 'contrib/cachetool.php';

// Config

set('repository', 'https://github.com/TumTum/jwconf_podcast_feed');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('podcast.jwconf.oik.gr')
    ->set('port', '8329')
    ->set('php_version', '8.3')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '/srv/podcast.jwconf.oik.gr/html')
    ->set('http_user', 'www-data')
;

// Hooks
after('deploy:failed', 'deploy:unlock');
after('deploy:success', 'cachetool:clear:opcache');
