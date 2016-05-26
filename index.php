<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

use Broadview\FileHandler;
use Broadview\Environment;

require_once("./vendor/autoload.php");

$watch_directory = '';
$log_directory = '';
$environment = new Environment();
