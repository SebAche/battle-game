#!/usr/bin/php -q
<?php

use App\UserInterface\Cli\PlayAGameCommand;

require 'src/util/Autoloader.php';
\App\Autoloader::register();


/* Define STDIN in case if it is not already defined by PHP for some reason 
if(!defined("STDIN")) {
define("STDIN", fopen('php://stdin','r'));
}*/

$script = new PlayAGameCommand();
$script->execute();
