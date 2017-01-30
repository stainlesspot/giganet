<?php

ini_set('log_errors', 1);
ini_set('error_log', '/tmp/php-error.log');


$requestedPath = explode('/', trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/'));

$pagesPath = $_SERVER['DOCUMENT_ROOT'].'/php/pages/';

switch ($requestedPath[0]) {
    case '':
        include $pagesPath.'index.php';
        break;
    case 'about':
        include $pagesPath.'about.php';
        break;
    case 'products':
        include $pagesPath.'products.php';
}