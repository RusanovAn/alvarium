<?php

/**Класс прослойка між Моделью ядра, та моделями додатку
 * Потрібен для розширення моделей додатку без зачіпання моделі ядра
 */

namespace app\models;

use core\Model;
use PDO;

class AppModel extends Model
{
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
