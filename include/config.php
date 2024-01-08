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



require_once __DIR__ ."/../classes/User.php";
require_once __DIR__ . "/../classes/Roles.php";
require_once __DIR__ ."/../classes/Permission.php";
require_once __DIR__ ."/../classes/Category.php";
require_once __DIR__ . "/../classes/Content.php";
require_once __DIR__ . "/../classes/Pages.php";
