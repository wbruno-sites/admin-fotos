<?php
header("Content-Type: text/html; charset=utf-8");


session_start();


$CONFIG = parse_ini_file('config.ini', true);
$DB = $CONFIG['dev'];

define('HOST', $DB['host']);
define('USER', $DB['user']);
define('PASS', $DB['pass']);
define('DB', $DB['db']);


$meta = Seo::metas();
$description = $meta['desc'];
$title = $meta['title'];
$cannonical = $meta['canonical'];
$url = Seo::getUrl();
$domain = Seo::getDomain();
