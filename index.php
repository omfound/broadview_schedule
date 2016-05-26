<?php

use Katzgrau\KLogger\Logger;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

use Broadview\FileHandler;
use Broadview\Environment;

require_once('./vendor/autoload.php');

$environment = new Environment('./../schedule.freespeech.org/broadview');
$logger = new Logger($environment->getLogDirectory(), Psr\Log\LogLevel::INFO, array('filename' => 'broadview-schedule'));

$app = new Application();
$app['environment'] = $environment;
$app['schedule_logger'] = $logger;
$app->get('/', function() use($app) { 
   $app['schedule_logger']->info('Schedule Requested.');
   try {
     $fh = new FileHandler($app['environment']);
     $nf = $fh->getNewestFile();
     $app['schedule_logger']->info('Latest Schedule: ' . $nf);
     $xml = $fh->getContents($nf);
     return $app->json($xml);
   }
   catch (\Exception $e) {
     $app['schedule_logger']->error($e->getMessage());
     return new Response('Internal Error.', 500);
   }
});
$app->run();

?>
