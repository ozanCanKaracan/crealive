<?php 
session_start();
include'db.php';
include'function.php';
error_reporting(E_ALL);
ini_set('display_errors', 0);

const MYSQL_HOST = 'localhost';
const MYSQL_DB = 'cms';
const MYSQL_USER = 'root';
const MYSQL_PASS = '';

const site_url = "http://localhost/cms/";

define('PATH', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . "/cms/");

include "../classes/Auth.php";
include "../classes/Roles.php";
include "../classes/Permission.php";

