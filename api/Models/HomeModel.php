<?php

namespace api\Models;

use api\Model;

class HomeModel extends Model
{
    public function getAll()
    {
        $return = [];
        $posts = $this->getForParent(0);
        foreach ($posts as $post) {
            $return[$post['id']] = $post;
            $return[$post['id']]['childrens'] = $this->getChildrens((int) $post['id']);
        }
        return $return;
    }

    public function getAllWithoutStructure()
    {
        return $this->db->getAll('posts');
    }

    public function getOne($id)
    {
        return $this->db->getFirst('posts', 'id = '.(int) $id);
    }

    public function getForParent($parent_id)
    {
        return $this->db->getAll('posts', ' parent_id = '.(int) $parent_id);
    }

    private function getChildrens($id)
    {
        $posts = $this->getForParent($id);
        $return = [];
        foreach ($posts as $post) {
            $return[$post['id']] = $post;
            $return[$post['id']]['childrens'] = $this->getChildrens((int) $post['id']);
        }
        return $return;
    }

    public function getChildrensIds($id)
    {
        $posts = $this->getForParent($id);
        $return = [];
        foreach ($posts as $post) {
            $childrens = $this->getChildrensIds((int) $post['id']);
            $return[] = $post['id'];
            foreach ($childrens as $children) {
                $return[] = $children;
            }
        }
        return $return;
    }
}