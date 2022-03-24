<?php

namespace system;

class MainController
{
    public $protection;

    public function __construct()
    {
        session_start();
        $this->protection = new ProtectionController();

        $class = 'Home';
        $methode = 'index';

        if (isset($this->protection->get['Class']) && !empty($this->protection->get['Class'])) {
            $class = $this->protection->get['Class'];
        }
        if (isset($this->protection->get['Methode']) && !empty($this->protection->get['Methode'])) {
            $methode = $this->protection->get['Methode'];
        }

        new RouteController($class,$methode);
    }
}