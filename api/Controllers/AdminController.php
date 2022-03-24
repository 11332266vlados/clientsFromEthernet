<?php

namespace api\Controllers;

use api\Controller;

class AdminController extends Controller
{

    public $tree = '';

    public function index()
    {
        if (!isset($_SESSION['admin'])) {
            $this->redirect('Login');
        }

        $HomeModel = $this->loader->loadModel('Home');
        $data['posts'] = $HomeModel->getAll();

        $this->renderTree($data['posts']);
        $data['tree'] = $this->tree;

        $this->render->render('Admin', $data);
    }

    public function edit()
    {
        if (!isset($_SESSION['admin'])) {
            $this->redirect('Login');
        }

        if (!isset($this->protection->get['postId'])) {
            $this->redirect('Admin');
        }

        if (!empty($this->protection->post)
            && isset($this->protection->post['title'])
            && isset($this->protection->post['description'])) {

            $AdminsModel = $this->loader->loadModel('Admins');
            if ($AdminsModel->updatePost($this->protection->get['postId'], $this->protection->post)) {
                $this->redirect('Admin');
            } else {
                $data['error'] = 'Ошибка при сохранении';
            }
        }

        $data['thisId'] = $this->protection->get['postId'];
        $data['parentId'] = 0;

        $HomeModel = $this->loader->loadModel('Home');
        $data['posts'] = $HomeModel->getAllWithoutStructure();
        $data['childsIds'] = $HomeModel->getChildrensIds($this->protection->get['postId']);
        $post = $HomeModel->getOne($this->protection->get['postId']);
        if (!empty($post)) {
            $data['parentId'] = $post['parent_id'];
            $data['title'] = $post['title'];
            $data['description'] = $post['description'];
        }

        $this->render->render('Admin_form', $data);
    }

    public function add()
    {
        if (!isset($_SESSION['admin'])) {
            $this->redirect('Login');
        }

        if (!isset($this->protection->get['parentId'])) {
            $this->redirect('Admin');
        }

        $HomeModel = $this->loader->loadModel('Home');

        if (!empty($this->protection->post)
            && isset($this->protection->post['title'])
            && isset($this->protection->post['description'])) {

            $AdminsModel = $this->loader->loadModel('Admins');
            if ($AdminsModel->addPost($this->protection->post)) {
                $this->redirect('Admin');
            } else {
                $data['error'] = 'Ошибка при сохранении';
            }
        }

        $data['posts'] = $HomeModel->getAllWithoutStructure();
        $data['childsIds'] = [];
        $data['parentId'] = $this->protection->get['parentId'];

        $this->render->render('Admin_form', $data);
    }

    private function renderTree($posts, $is_child = false)
    {
        foreach ($posts as $post) {
            $this->tree .= "<ul ";
            $this->tree .= "class=''><li><span><span>".$post['title']."</span></span>";
            $this->tree .= '<a href="?Class=Admin&Methode=edit&postId='.$post['id'].'"><svg xmlns="http://www.w3.org/2000/svg" width="12" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/></svg></a>';
            $this->tree .= '<a href="?Class=Admin&Methode=add&parentId='.$post['id'].'"><svg xmlns="http://www.w3.org/2000/svg" width="12" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg></a>';
            if (!empty($post['childrens'])) {
                $this->renderTree($post['childrens'], true);
            }
            $this->tree .= "</li></ul>";
        }
    }
}