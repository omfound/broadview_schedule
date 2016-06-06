<?php

namespace Broadview;

class FileHandler {
  protected $allowed_extensions = array('txt', 'csv');
  protected $new_line = "\n";
  protected $delimiter = "\t";
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
    $data = file_get_contents($file);
    $data = explode($this->new_line, $data); 
    $headers = array_shift($data);
    $headers = explode($this->delimiter, str_replace('"', '', $headers));
    $output = array();
    foreach ($data AS $row) {
      $bits = explode($this->delimiter, str_replace('"', '', utf8_encode($row)));
      if (count($bits) == count($headers)) {
        $output[] = array_combine($headers, $bits);
      }
    }
    return $output;
  }
}

?>
