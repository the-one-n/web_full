<?php
// HTTP
define('HTTP_SERVER', 'http://opencart.prod/');

// HTTPS
define('HTTPS_SERVER', 'http://opencart.prod/');

// DIR
define('DIR_APPLICATION', dirname(__FILE__) . "/catalog/");
define('DIR_SYSTEM', dirname(__FILE__) . "/system/");
define('DIR_IMAGE', dirname(__FILE__) . "/image/");
define('DIR_STORAGE', DIR_SYSTEM . '../../ocstorages/storage/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/theme/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');
define('DIR_CACHE', DIR_STORAGE . 'cache/');
define('DIR_DOWNLOAD', DIR_STORAGE . 'download/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_MODIFICATION', DIR_STORAGE . 'modification/');
define('DIR_SESSION', DIR_STORAGE . 'session/');
define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'sql11.freesqldatabase.com');
define('DB_USERNAME', 'sql11439627');
define('DB_PASSWORD', 'wl2vmA915Y');
define('DB_DATABASE', 'sql11439627');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');
