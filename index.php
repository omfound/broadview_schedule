<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

use Broadview\FileHandler;
use Broadview\Environment;

require_once('./vendor/autoload.php');

$watch_directory = '/public_html/schedule.freespeech.org/broadview';
//$environment = new Environment($watch_directory);

if (class_exists('Application')) {
  print 'hi im here.';
}
else {
  print 'boo';
}

?>
