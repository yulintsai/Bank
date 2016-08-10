<?php
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Server.php';

header("Content-Type:text/html; charset=utf-8");
date_default_timezone_set('Asia/Taipei');
session_start();

$app = new App();
