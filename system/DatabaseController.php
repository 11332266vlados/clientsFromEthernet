<?php

namespace system;

class DatabaseController
{
    private $config = [
        'host' => 'localhost',
        'user' => 'cfe',
        'pass' => 'efwkF6sZ5tjNSCwm',
        'name' => 'cfe',
    ];
    private $db;

    public function __construct()
    {
        $this->db = mysqli_connect($this->config['host'], $this->config['user'], $this->config['pass'],
            $this->config['name']);

        if ($this->db->connect_error) {
            echo "Нет подключения к БД. Ошибка:".mysqli_connect_error();
            exit;
        }

    }

    public function updateQuery($query)
    {
        $returnData = $this->db->query($query);
        if ($returnData) {
            return true;
        } else {
            return false;
        }
    }

    public function query($query, $justFirst = false)
    {
        $returnData = $this->db->query($query);
        if ($returnData) {
            while ($return[] = mysqli_fetch_assoc($returnData)) {
            }
            array_pop($return);
            if ($justFirst && isset($return[0])) {
                return $return[0];
            }
            return $return;
        } else {
            return [];
        }
    }

    public function getAll($table, $where = '')
    {
        $sql = 'SELECT * FROM ' . $table;
        if (!empty($where)) {
            $sql .= ' WHERE ' . $where;
        }
        return $this->query($sql);
    }

    public function insert($table, $data)
    {
        $sql = 'INSERT INTO ' . $table;
        $keys = [];
        $values = [];
        foreach ($data as $key => $value){
            $keys[] = $key;
            $values[] = "'$value'";
        }
        $sql .= '(' . implode(',',$keys) . ') VALUES ('. implode(',',$values) . ')';

        return $this->updateQuery($sql);
    }

    public function update($table, $data, $where = '')
    {
        $sql = 'UPDATE ' . $table . ' SET ';
        $updateInsert = [];
        foreach ($data as $key => $value){
            $updateInsert[] = "$key = '$value'";
        }
        $sql .= implode(', ',$updateInsert);

        if (!empty($where)) {
            $sql .= ' WHERE ' . $where;
        }
        return $this->updateQuery($sql);
    }

    public function getFirst($table, $where = '')
    {
        $sql = 'SELECT * FROM ' . $table;
        if (!empty($where)) {
            $sql .= ' WHERE ' . $where;
        }
        return $this->query($sql, true);
    }
}