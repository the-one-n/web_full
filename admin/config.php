<?php
// HTTP
define('HTTP_SERVER', 'http://opencart.prod/admin/');
define('HTTP_CATALOG', 'http://opencart.prod/');

// HTTPS
define('HTTPS_SERVER', 'http://opencart.prod/admin/');
define('HTTPS_CATALOG', 'http://opencart.prod/');

// DIR
$dir = dirname(dirname(__FILE__));
define('DIR_APPLICATION', $dir . '/admin/');
define('DIR_SYSTEM', $dir . '/system/');
define('DIR_IMAGE', $dir . '/image/');
define('DIR_STORAGE', DIR_SYSTEM . '../../ocstorages/storage/');
define('DIR_CATALOG', $dir . '/catalog/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/template/');
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

// OpenCart API
define('OPENCART_SERVER', 'https://www.opencart.com/');
