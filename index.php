<?php
// (A) SETTINGS
define("URL_PATH", "/"); // CHANGE THIS IF NOT ROOT!
define("PATH_CONTENTS", __DIR__ . DIRECTORY_SEPARATOR . "contents" . DIRECTORY_SEPARATOR);
define("PATH_TEMPLATES", __DIR__ . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR);

// (B) STRIP PATH DOWN TO AN ARRAY 
// E.G. http://site.com/hello/world/ > $_PATH = ["hello", "world"] 
$_PATH = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
$_PATH = substr($_PATH, strlen(URL_PATH)); 
$_PATH = rtrim($_PATH, '/');
$_PATH = explode("/", $_PATH);

// (C) FILE NAME YOGA
// E.G. $_PATH = ["hello", "world"] > $_FILE = "hello-world.php";
// IF $_PATH = [] > $_FILE = "home.php";
if (count($_PATH) > 1) {
  $_FILE = implode("-", $_PATH) . ".php";
} else {
  $_FILE = ($_PATH[0]=="" ? "home" : $_PATH[0]) . ".php";
}

// (D) LOAD PAGE
if (file_exists(PATH_CONTENTS . $_FILE)) {
  require PATH_CONTENTS . $_FILE;
} else {
  header("HTTP/1.0 404 Not Found");
  echo "OOPS. FILE NOT FOUND";
  // You can serve your own custom 404 page if you want
}
?>