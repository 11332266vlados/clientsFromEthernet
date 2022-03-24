<?php

namespace api\Controllers;

use api\Controller;

class HomeController extends Controller
{
    public $tree = '';

    public function index()
    {
        $HomeModel = $this->loader->loadModel('Home');

        $data['posts'] = $HomeModel->getAll();
        $data['title'] = 'Дерево постов';

        $this->renderTree($data['posts']);
        $data['tree'] = $this->tree;

        $this->render->render('Home', $data);
    }

    private function renderTree($posts, $is_child = false)
    {
        foreach ($posts as $post) {
            $this->tree .= "<ul ";
            if ($is_child) {
                $this->tree .= " style='display:none;' ";
            }
            $this->tree .= "class='closed can_closed_".$post['parent_id']."'><li><span><span>".$post['title']."</span></span>";
            if (!empty($post['childrens'])) {
                $this->tree .= '<span class="can_closed plus_'.$post['id'].'" onclick="openClose('.$post['id'].')"><svg xmlns="http://www.w3.org/2000/svg" width="12" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></span>';
                $this->tree .= '<span style="display:none" class="can_closed  minus_'.$post['id'].'" onclick="openClose('.$post['id'].')"><svg xmlns="http://www.w3.org/2000/svg" width="12" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg></span>';
                $this->renderTree($post['childrens'], true);
            }
            $this->tree .= "</li></ul>";
        }
    }
}