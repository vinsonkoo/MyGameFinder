<?php

// autoload our classes
function __autoload($class_name) {
  $dirs = array(
    '../php/classes/',
    '../php/classes/beans/',
    '../php/classes/utils/',
  );
  foreach($dirs as $dir)
  {
    $file = $dir . $class_name . '.class.php';
    //if (class_exists($file, false)) {
    if (file_exists($file)) {
      include_once($file);
    }
  }
}
