<?php 
session_start();
include'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 2);

const MYSQL_HOST = 'localhost';
const MYSQL_DB = 'puantaj';
const MYSQL_USER = 'root';
const MYSQL_PASS = '';

const site_url = "http://localhost/cms/";

define('PATH', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . "/cms/");

