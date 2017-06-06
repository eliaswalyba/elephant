<?php

 function debug($var) {

     if(\Config\Conf::$debug > 0) {
         $debug = debug_backtrace();
         echo '<div style="width: 100%; border: 0px solid black; padding: 5px">';
         echo '<header style="margin: 0px; width: 100%">';
         echo '<h1
                    style="color: darkslategray;
                    font-family: Century Gothic;
                    font-weight: normal;
                    font-size: 25px; text-align: center">
                    Elephant Framework Debuger
                    </h1>';
         echo '<header>';
         echo '<hr />';
         echo '<p>
                <a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false">
                    <strong>'.$debug[0]["file"].'</strong> &rarr; ligne: '.$debug[0]["line"].'
                </a>
            </p>';
         echo '<ol style="display: none">';
         foreach($debug as $k => $v) {
             if($k > 0) {
                 echo '<li><strong>'.$v["file"].'</strong> &rarr; ligne: '.$v["line"].'</li>';
             }
         }
         echo '</ol>';
         echo '<pre>';
         print_r($var);
         echo '</pre>';
         echo '</div>';
         die();
     }
 }