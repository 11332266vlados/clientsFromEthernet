<?php

namespace api;

use system\DatabaseController;

class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new DatabaseController();
    }
}