<?php $start = microtime(true);

define('DS',                              DIRECTORY_SEPARATOR);
define('WEBROOT',                           dirname(__FILE__));
define('ROOT',                               dirname(WEBROOT));
define('KERNEL',                         ROOT . DS . 'kernel');
define('HOME',                             ROOT . DS . 'home');
define('BASE_URL',  dirname(dirname($_SERVER['SCRIPT_NAME'])));

require_once ROOT . DS . 'config' . DS . 'includes.php';
new \Kernel\Dispatcher();


//echo '<div style="background-color: darkred; padding: 10px; margin: 0px; position: fixed; bottom: 0px; left: 0px; right: 0px;color: white; font-family: Calibri; text-align: center">';
//echo 'This page is generated within '.round(microtime(true) - $start, 5).' secondes';
//echo '</div>';
