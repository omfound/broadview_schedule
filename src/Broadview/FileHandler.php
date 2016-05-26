<?php

namespace Broadview;

class FileHandler {
  protected $allowed_extensions = array('xml');
  public function __construct(Environment $environment) {
    $this->environment = $environment;
  }
  public function getNewestFile() {
    $watch_directory = $this->environment->getWatchDirectory();
    $files = scandir($watch_directory);
    $ordered_files = array();
    foreach($files AS $file) {
      $path = $watch_directory . '/' . $file;
        $info = pathinfo($path);
      if (in_array($info['extension'], $this->allowed_extensions)) {
        $updated_date = filemtime($path);
        $ordered_files[$updated_date] = $path;
      }
    }
    ksort($ordered_files);
    return array_pop($ordered_files);
  }
  public function getContents($file) {
    return simplexml_load_file($file);
  }
}

?>
