<?php

namespace system;

class ProtectionController
{
    public $get;
    public $post;

    public function __construct()
    {
        if (isset($_GET) && !empty($_GET)) {
            $this->get = $this->protect($_GET);
        }
        if (isset($_POST) && !empty($_POST)) {
            $this->post = $this->protect($_POST);
        }
    }

    private function protect($pr)
    {
        $return = [];
        if (is_array($pr)) {
            foreach ($pr as $key => $p) {
                $return[$key] = $this->protect($p);
            }
        } else {
            return htmlspecialchars(addslashes($pr));
        }
        return $return;
    }

}