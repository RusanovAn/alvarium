<?php

namespace app\models;

use PDO;

class EmployesModel extends AppModel
{
    public function getEmployers(int $idDepartment, int $countOnPage, int $page): array
    {
        $department = '';
        if ($idDepartment !== 0) {
            $department = 'WHERE `departments`.`id`=:idDepartment';
        }
        $offsetCount = $countOnPage*($page-1);

        /** Формуємо запит*/
        $select = "SELECT 
                    `emploers`.`pib` AS pib,
                    `emploers`.`birthday` AS birthday,
                    `departments`.`title` AS department,
                    `positions`.`title` AS position,
                    `salary_type`.`title` AS salaryType,
                    `emploers_rate`.`rate` AS rate,
                    `emploers_worked_time`.`value` * `emploers_rate`.`rate` AS salary
                    FROM `emploers`
                    LEFT JOIN `departments_emploers` ON `departments_emploers`.`emploer_id` = `emploers`.`id`
                    LEFT JOIN `departments` ON `departments_emploers`.`department_id` = `departments`.`id`                    
                    LEFT JOIN `emploers_positions` ON `emploers_positions`.`user_id` = `emploers`.`id`
                    LEFT JOIN `positions` ON `positions`.`id` = `emploers_positions`.`position_id`
                    LEFT JOIN `emploers_salary_type` ON `emploers_salary_type`.`user_id` = `emploers`.`id`
                    LEFT JOIN `salary_type` ON `salary_type`.`id` = `emploers_salary_type`.`salary_type_id`
                    LEFT JOIN `emploers_rate` ON `emploers_rate`.`user_id` = `emploers`.`id`
                    LEFT JOIN `emploers_worked_time` ON `emploers_worked_time`.`user_id` = `emploers`.`id`
                    {$department} LIMIT :offsetCount, :countOnPage";
        /** Підготовлюємо запит*/
        $result = $this->db_connect->prepare($select);
        if (!empty($department)) {
            $result->bindParam(':idDepartment', $idDepartment, PDO::PARAM_INT);
        }
        $result->bindParam(':offsetCount', $offsetCount, PDO::PARAM_INT);
        $result->bindParam(':countOnPage', $countOnPage, PDO::PARAM_INT);
        /** Виконуємо запит*/
        $result->execute();
        /** Отримуємо результат*/
        $data = $result->fetchAll();

//        print_r($select);
//        print_r($result->errorInfo());
//        die;
        /** Повераємо результуючий массив*/
        return $data;
    }
    public function getCount(int $idDepartment): int
    {

        $department = '';
        if ($idDepartment !== 0) {
            $department = 'LEFT JOIN `departments_emploers` ON `departments_emploers`.`emploer_id` = `emploers`.`id`
                            LEFT JOIN `departments` ON `departments_emploers`.`department_id` = `departments`.`id` 
                            WHERE `departments`.`id`=:idDepartment';
        }

        /** Формуємо запит*/
        $select = "SELECT COUNT(*) FROM `emploers` {$department}";
        /** Підготовлюємо запит*/
        $result = $this->db_connect->prepare($select);
        if (!empty($department)) {
            $result->bindParam(':idDepartment', $idDepartment, PDO::PARAM_INT);
        }
        /** Виконуємо запит*/
        $result->execute();
        /** Отримуємо результат*/
        $data = $result->fetchColumn();

//        print_r($select);
//        print_r($result->errorInfo());
//        die;

        return $data;
    }

    public function getDepartment(int $department) :int
    {
        /** Формуємо запит*/
        $select = "SELECT `id` FROM `departments` WHERE `id`=:id";
        /** Підготовлюємо запит*/
        $statement = $this->db_connect->prepare($select);
        /** Виконуємо запит*/
        $statement->execute(['id' => $department]);

        return $statement->fetch(PDO::FETCH_COLUMN);
    }
    public function getAllDepartments()
    {
        /** Формуємо запит*/
        $select = "SELECT `departments`.`id` AS `id`, `departments`.`title` AS `title` FROM `departments`";
        /** Підготовлюємо запит*/
        $statement = $this->db_connect->prepare($select);
        /** Виконуємо запит*/
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_UNIQUE);
    }

}
