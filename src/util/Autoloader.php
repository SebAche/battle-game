<?php

namespace App;

class Autoloader {

    static function autoload($class){

        if (strpos($class, __NAMESPACE__.'\\') === 0){
            $class= str_replace(__NAMESPACE__ . '\\', '', $class);
            $class= str_replace('\\', '/', $class);

            require 'src/' . $class . '.php';
        }        
    }

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
}