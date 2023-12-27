<?php 
session_start();
include'db.php';
include'function.php';
error_reporting(E_ALL);
ini_set('display_errors', 2);

const MYSQL_HOST = 'localhost';
const MYSQL_DB = 'cms';
const MYSQL_USER = 'root';
const MYSQL_PASS = '';

const site_url = "http://localhost/cms/";


include "../classes/User.php";
include "../classes/Roles.php";
include "../classes/Permission.php";
include "../classes/Category.php";
include "../classes/Content.php";
include "../classes/Pages.php";



