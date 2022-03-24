<?php

namespace api\Models;

use api\Model;

class AdminsModel extends Model
{
    public function loginAdmin($login, $password)
    {
        return $this->db->getAll('admins', " login = '$login' AND password = '$password'");
    }

    public function updatePost($post_id, $data)
    {
        $update = [
            'parent_id'   => $data['parent_id'],
            'title'       => $data['title'],
            'description' => $data['description'],
        ];
        return $this->db->update('posts', $update, "id = $post_id");
    }

    public function addPost($data)
    {
        $add = [
            'parent_id'   => $data['parent_id'],
            'title'       => $data['title'],
            'description' => $data['description'],
        ];
        return $this->db->insert('posts', $add);
    }
}