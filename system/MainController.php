<?php
namespace system;
use system\ProtectionController;
use system\DatabaseController;
use system\RouteController;
class MainController
{
    public $db;
    public $protection;
    public function __construct()
    {
        $this->protection = new ProtectionController();
        if(isset($this->protection->get['Route']) && !empty($this->protection->get['Route'])){
            $this->debug($this->protection->get);
        }
    }
    public function debug($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}