<?php
if (!defined('ENV'))
    define('ENV', getenv('SF_ENV'));
define('LIB', PATH . 'libraries/');
define('MODELS', PATH . 'models/');
define('VIEWS', PATH . 'views/');
define('CONTROLLERS', PATH . 'controllers/');
define('USER_DIR', 'E:\\');

if (!defined('BASE_URL_PART'))
    define("BASE_URL_PART", 0);

if (!defined('DB_HOST'))
    define("DB_HOST", "192.168.1.43:3366");

if (!defined('DB_NAME'))
    define("DB_NAME", "supfile");

if (!defined('DB_USER'))
    define("DB_USER", "username");

if (!defined('DB_PASSWORD'))
    define("DB_PASSWORD", 'password');

