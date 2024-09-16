{ pkgs, config, inputs, ... }:

{
  dotenv.enable = false;
  dotenv.disableHint = true;

# Mysql
  services.mysql.enable = true;
  services.mysql.initialDatabases = [
   { name = "JWPodcast"; }
  ];
  services.mysql.ensureUsers = [
    {
      name = "JWPodcast";
      password = "JWPodcast";
      ensurePermissions = {
        "*.*" = "ALL PRIVILEGES";
      };
    }
  ];

  scripts.artisan.exec = "php $DEVENV_ROOT/artisan $@";

  scripts.startWorkerX.exec = "XDEBUG_SESSION=1 php -dxdebug.mode=debug $DEVENV_ROOT/artisan queue:work";

  scripts.phpx.exec = "XDEBUG_SESSION=1 php -dxdebug.mode=debug $@";


  # https://devenv.sh/basics/
#  env.GREET = "devenv";

  # https://devenv.sh/packages/
  packages = [ pkgs.yarn pkgs.npm-check-updates pkgs.stripe-cli pkgs.ghostscript];

  languages.javascript.enable = true;
  languages.php.enable = true;
  languages.php.version = "8.3";


  languages.php.extensions = [
    "xdebug"
    "imagick"
  ];

  languages.php.fpm.phpOptions =
    ''
      memory_limit = -1
      realpath_cache_ttl = 3600
      session.gc_probability = 0
      display_errors = On
      display_startup_errors = true
      error_reporting = E_ALL
      html_errors = true
      assert.active = 0
      zend.detect_unicode = 0
      opcache.memory_consumption = 256M
      opcache.interned_strings_buffer = 20
      opcache.enable_cli = -1
      opcache.enabled = -1
      zend.assertions = 0
      short_open_tag = 0
      xdebug.mode = "debug"
      xdebug.start_with_request = "trigger"
      xdebug.discover_client_host = 1
      xdebug.var_display_max_depth = -1
      xdebug.var_display_max_data = -1
      xdebug.var_display_max_children = -1
    ''
  ;

  languages.php.fpm.pools.web = {
      settings = {
        "clear_env" = "no";
        "pm" = "dynamic";
        "pm.max_children" = 10;
        "pm.start_servers" = 2;
        "pm.min_spare_servers" = 1;
        "pm.max_spare_servers" = 10;
      };
    };

  hosts = {
      "JWPodcast.local" = "127.0.0.1";
    };

  services.caddy.enable = true;
  services.caddy.virtualHosts."https://JWPodcast.local:8080" = {
    extraConfig = ''
      root * ./public

      try_files {path} /index.php?{query}
      file_server

      php_fastcgi unix/${config.languages.php.fpm.pools.web.socket}
    '';
  };

  services.mailhog.enable = true;
}
