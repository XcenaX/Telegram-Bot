<?php

namespace Models;

use Core\Database;

abstract class Table{
    protected static $table_name;

    static function select($join = "*", $columns = null, $where = null){
        return Database::instance()->select($join, $columns, $where);
    }

    function get($join = null, $columns = null, $where = null) {
        return Database::instance()->get(static::$table_name, $join, $columns, $where);
    }

    function insert($datas) {
        return Database::instance()->insert(static::$table_name, $datas);
    }

    function update($data, $where = null) {
        return Database::instance()->update(static::$table_name, $data, $where);
    }

    function delete($where) {
        return Database::instance()->delete(static::$table_name, $where);
    }

    function has($where) {
        return Database::instance()->has(static::$table_name, $where);
    }

    function getById($id) {
        return $this->get("*", [
            "id" => $id
        ]);
    }
}