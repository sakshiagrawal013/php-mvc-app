<?php

define('SITE_NAME', 'my-blog');


define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', 'http://localhost:8181');

define('MYSQLI_DB_HOST', $_ENV['DB_HOST']);
define('MYSQLI_DB_USER', $_ENV['DB_USER']);
define('MYSQLI_DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('MYSQLI_DB_NAME', $_ENV['DB_DATABASE_NAME']);
