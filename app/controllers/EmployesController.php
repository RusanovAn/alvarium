<?php

/**
 * Клас ReportController описує методи роботи зі сторінкою звітів
*/

namespace app\controllers;

use app\models\EmployesModel;

class EmployesController extends AppController
{
    public $model_obj;
    private int $department = 0;
    private int $countOnPage = COUNTONPAGE['default'];
    private int $page = 1;
    private string $url = "/employes/";

    /**
     * В конструкторі створюємо об'єкт моделі
     */
    public function __construct()
    {
        parent::__construct();
        $this->model_obj = new EmployesModel();
        $this->setDepartment();
        $this->setCountOnPage();
        $this->setPage();
        $this->setUrl();
    }

    /**
     * метод indexAction відповідає за підготовку данних для головної сторінки звіту
     */
    public function indexAction()
    {
        $data = $this->model_obj->getEmployers($this->department, $this->countOnPage, $this->page);
        $departments = $this->model_obj->getAllDepartments();
        $url = $this->url;
        $activeDepartment = $this->department;
        $countRows = $this->model_obj->getCount($this->department);
        $pagination = [
            'countRows' => $countRows,
            'page' => $this->page,
            'countPages' => ceil($countRows / $this->countOnPage),
            'countOnPage' => $this->countOnPage,
        ];
        $this->set(compact('data', 'departments', 'url', 'pagination', 'activeDepartment'));
    }

    private function isDepartment (int $idDepartment): bool
    {
        if ($idDepartment === 0) {
            return false;
        }
        $isDepartment = $this->model_obj->getDepartment(ROUT['department']);
        if ($isDepartment === $idDepartment) {
            return true;
        }
        return false;
    }

    private function setDepartment (): void
    {
        if (isset(ROUT['department']) && !empty(ROUT['department']) && $this->isDepartment(ROUT['department'])) {
            $this->department = ROUT['department'];
        }
    }
    private function setCountOnPage (): void
    {
        if (isset(ROUT['count']) && !empty(ROUT['count'])) {
            $this->countOnPage = ROUT['count'];
        }
    }
    private function setPage (): void
    {
        if (isset(ROUT['page']) && !empty(ROUT['page'])) {
            $this->page = ROUT['page'];
        }
    }
    private function setUrl (): void
    {
        if ($this->department !== 0) {
            $this->url .= "{$this->department}/";
        }
    }

}
