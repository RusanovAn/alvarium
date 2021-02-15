<?php

/**
 * Основний клас моделі, відповідає за підключення до бази данних
 * в конструкторі створює нове PDO підключення для послідовниуів
 */

namespace core;

class Model
{
    /**
     * @param $db_connect - об'єкт підключення до БД
     */
    public $db_connect;
    /**
     * @param $db_conf - данні підключення до бази данних (сервер, назва бд, логін та пароль)
     */
    public $db_conf;
    public function __construct()
    {
        $this->db_conf = include ROOT . '/configs/db.php';
        try {
            $this->db_connect = new \PDO(
                $this->db_conf['driver'] .
                ':host=' . $this->db_conf['host'] .
                ';dbname=' . $this->db_conf['db'] .
                ';charset=utf8',
                $this->db_conf['user'],
                $this->db_conf['pass'],
                $this->db_conf['opt']
            );
        } catch (\Exception $e) {
            echo 'Error!' . $e->getMessage();
        }
    }
}
