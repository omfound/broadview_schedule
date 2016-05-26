<?php

namespace Broadview;

class Environment {
  protected $watch_directory;
  protected $log_directory;
  public function __construct($watch_directory, $log_directory = './logs') {
    // Watch directory
    if (!file_exists($watch_directory)) {
      throw new \Exception("Directory $watch_directory does not exist.");
    }
    $this->watch_directory = $watch_directory;
    // Log directory
    $this->log_directory = $log_directory;
  } 
  public function getWatchDirectory() {
    return $this->watch_directory;
  }
  public function getLogDirectory() {
    return $this->log_directory;
  }
}

?>
