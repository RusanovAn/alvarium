<?php

namespace app\models;

use PDO;

class ImportModel extends AppModel
{
    public function setRow(string $table, array $data) : int
    {
        /** Формуємо частину запиту з переліком стовпчиків таблиці*/
        $column = '`' . implode('`, `', array_keys($data)) . '`';
        /** Формуємо частину запиту з переліком значень*/
        $prepare_column = ':' . implode(', :', array_keys($data));
        /** Формуємо загальний запит*/
        $insert = "INSERT INTO {$table} ({$column}) VALUES ({$prepare_column})";
        /** Робимо запис в базу данних*/
        $res = $this->db_connect->prepare($insert);
        $res->execute($data);
        return $this->db_connect->lastInsertId();
    }
    public function clearTables ()
    {
        $tables = [
            '`departments`',
            '`departments_emploers`',
            '`emploers`',
            '`emploers_positions`',
            '`emploers_rate`',
            '`emploers_salary_type`',
            '`emploers_worked_time`',
            '`positions`',
            '`salary_type`',
            ];
        foreach ($tables as $table) {
            $this->db_connect->query("TRUNCATE {$table}");
        }
    }
}
