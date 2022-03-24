<?php

namespace system;

class RouteController
{
    public function __construct($class, $methode)
    {
        $filename = $_SERVER['DOCUMENT_ROOT'].'/api/Controllers/'.$class.'Controller.php';
        $className = 'api\Controllers\\'.$class.'Controller';

        if (file_exists($filename)) {
            include_once($filename);
            $instance = new $className;
            $instance->$methode();
        }else{
            die('Контроллер '.$filename . ' Не найден');
        }
    }
}