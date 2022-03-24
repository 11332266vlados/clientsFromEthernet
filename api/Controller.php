<?php

namespace api;

use system\LoaderController;
use system\ProtectionController;
use system\RenderController;

class Controller
{
    public $loader;
    public $render;
    public $protection;

    public function __construct()
    {
        $this->protection = new ProtectionController();
        $this->loader = new LoaderController();
        $this->render = new RenderController();
    }

    public function debug($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    public function redirect($class,$methode = 'index')
    {
        header('Location: https://'.$_SERVER['HTTP_HOST'].'?Class='.$class.'&Methode='.$methode, true, 301);
    }

}