<?php


// HTTP
define('HTTP_SERVER', 'https://'.$_SERVER['HTTP_HOST'].'/adminipc/');
define('HTTP_CATALOG', 'https://'.$_SERVER['HTTP_HOST'].'/');

// HTTPS
define('HTTPS_SERVER', 'https://'.$_SERVER['HTTP_HOST'].'/adminipc/');
define('HTTPS_CATALOG', 'https://'.$_SERVER['HTTP_HOST'].'/');

define('DIR_APPLICATION', __DIR__ .'/../adminipc/');
define('DIR_SYSTEM', __DIR__ .'/../system/');
define('DIR_LANGUAGE', __DIR__ .'/../adminipc/language/');
define('DIR_TEMPLATE', __DIR__ .'/../adminipc/view/template/');
define('DIR_CONFIG', __DIR__ .'/../system/config/');
define('DIR_IMAGE', __DIR__ .'/../image/');
define('DIR_CACHE', __DIR__ .'/../system/cache/');
define('DIR_DOWNLOAD', __DIR__ .'/../system/download/');
define('DIR_UPLOAD', __DIR__ .'/../system/upload/');
define('DIR_LOGS', __DIR__ .'/../system/logs/');
define('DIR_MODIFICATION', __DIR__ .'/../system/modification/');
define('DIR_CATALOG', __DIR__ .'/../catalog/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'thinhtien');
define('DB_PASSWORD', 'asajejysu');
define('DB_DATABASE', 'zadmin_thinhtien');
define('DB_PREFIX', 'xtn_');
