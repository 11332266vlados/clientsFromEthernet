<?php

namespace system;

class LoaderController
{
    public function loadModel($name)
    {
        $filename = $_SERVER['DOCUMENT_ROOT'].'/api/Models/'.$name.'Model.php';
        $className = 'api\Models\\'.$name.'Model';

        if (file_exists($filename)) {
            include_once($filename);
            return new $className;

        } else {
            die('Модель ' . $filename . ' Не найдена');
        }
    }
}