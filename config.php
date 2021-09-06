<?php
// HTTP
define('HTTP_SERVER', 'http://opencart.prod/');

// HTTPS
define('HTTPS_SERVER', 'http://opencart.prod/');

// DIR
define('DIR_APPLICATION', 'E:/Soft/OpenServer/domains/opencart.prod/catalog/');
define('DIR_SYSTEM', 'E:/Soft/OpenServer/domains/opencart.prod/system/');
define('DIR_IMAGE', 'E:/Soft/OpenServer/domains/opencart.prod/image/');
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
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'ocadmin');
define('DB_PASSWORD', 'admin');
define('DB_DATABASE', 'opencartprod');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');