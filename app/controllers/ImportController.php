<?php

namespace app\controllers;

use app\models\EmployesModel;
use app\models\ImportModel;
use DOMAttr;
use DOMDocument;

class ImportController extends AppController
{
    /**
     * @var ImportModel
     */
    private ImportModel $model_obj;
    private int $department = 0;
    private string $url = "/import/";

    public function __construct()
    {
        parent::__construct();
        $this->model_obj = new ImportModel();
    }
    public function indexAction()
    {
        $data = '';
        $departments = $this->model_obj->getAllDepartments();
        $url = $this->url;
        $activeDepartment = $this->department;
        $this->set(compact('departments', 'url', 'activeDepartment'));
    }
    public function clearTablesAction()
    {
        $this->model_obj->clearTables();
        echo 'Таблица очищена';
        exit();
    }
    public function generateXmlAction()
    {
        $dom = new DOMDocument();
            $dom->encoding = 'utf-8';
            $dom->xmlVersion = '1.0';
            $dom->formatOutput = true;

        $xml_file_name = ROOT.'/files/employees.xml';
        $db = $dom->createElement('db');
            $employers = $dom->createElement('Employers');
            for ($i = 1; $i <= 1000; $i++) {
                $employer = $dom->createElement('employer');
                $employerFields = $this->generateEmployer($i);
                foreach ($employerFields as $k => $value) {
                    $field = $dom->createElement($k, $value);
                    $employer->appendChild($field);
                }
                $employers->appendChild($employer);
            }
            $db->appendChild($employers);

            $departments = $dom->createElement('Departments');
            for ($i = 1; $i <= 10; $i++) {
                $department = $dom->createElement('Department');
                    $field = $dom->createElement('title', 'Департамент_'.$i);
                    $department->appendChild($field);
                $departments->appendChild($department);
            }
            $db->appendChild($departments);

            $positions = $dom->createElement('Positions');
            for ($i = 1; $i <= 10; $i++) {
                $position = $dom->createElement('Position');
                    $field = $dom->createElement('title', 'Должность_'.$i);
                    $position->appendChild($field);
                $positions->appendChild($position);
            }
            $db->appendChild($positions);

            $salaryTypes = $dom->createElement('SalaryTypes');
                $salaryType = $dom->createElement('SalaryType');
                    $field = $dom->createElement('title', 'Почасовая');
                    $salaryType->appendChild($field);
                $salaryTypes->appendChild($salaryType);
                $salaryType = $dom->createElement('SalaryType');
                    $field = $dom->createElement('title', 'Ставка');
                    $salaryType->appendChild($field);
                $salaryTypes->appendChild($salaryType);
            $db->appendChild($salaryTypes);
        $dom->appendChild($db);
        $dom->save($xml_file_name);
        echo "$xml_file_name успешно создан";
        exit;
    }
    public function xmlToSqlAction()
    {
        $xml = simplexml_load_file(ROOT.'/files/employees.xml');
        $this->employersToDb($xml->Employers->employer);
        $this->departmentsToDb($xml->Departments->Department);
        $this->positionsToDb($xml->Positions->Position);
        $this->salaryTypesToDb($xml->SalaryTypes->SalaryType);

        echo 'База данных заполонена';
        exit();
    }

    private function generateEmployer(int $i) : array
    {
        $start = mktime(0,0,0,1,1,1980);
        $end  = time();
        $randomStamp = rand($start,$end);
        $salary_type_id = rand(1, 2);
        return [
            'pib' => 'ФИО №' . $i,
            'birthday' => date('Y-m-d',$randomStamp),
            'rate' => ($salary_type_id == 1) ? rand(20, 400) : rand(2000, 4000),
            'salary_type_id' => $salary_type_id,
            'position_id' => rand(1, 10),
            'department_id' => rand(1, 10),
            'value' => ($salary_type_id == 1) ? rand(400, 800) : 1,
        ];
    }
    private function employersToDb(object $employers): void
    {
        foreach ($employers as $k => $employer) {
            $data = [
                'pib' => (string) $employer->pib,
                'birthday' => (string) $employer->birthday,
            ];
            $employerId = $this->model_obj->setRow('emploers', $data);

            $data = [
                'emploer_id' => $employerId,
                'department_id' => (int) $employer->department_id,
            ];
            $this->model_obj->setRow('departments_emploers', $data);

            $data = [
                'user_id' => $employerId,
                'value' => (int) $employer->value,
            ];
            $this->model_obj->setRow('emploers_worked_time', $data);

            $data = [
                'user_id' => $employerId,
                'position_id' => (int) $employer->position_id,
            ];
            $this->model_obj->setRow('emploers_positions', $data);

            $data = [
                'user_id' => $employerId,
                'salary_type_id' => (int) $employer->salary_type_id,
            ];
            $this->model_obj->setRow('emploers_salary_type', $data);

            $data = [
                'user_id' => $employerId,
                'rate' => (int) $employer->rate,
            ];
            $this->model_obj->setRow('emploers_rate', $data);
        }
    }
    private function departmentsToDb(object $departments): void
    {
        foreach ($departments as $k => $department) {
            $data = [
                'title' => (string) $department->title,
            ];
            $departmentId = $this->model_obj->setRow('departments', $data);
        }
    }
    private function positionsToDb(object $positions): void
    {
        foreach ($positions as $k => $position) {
            $data = [
                'title' => (string) $position->title,
            ];
            $positionId = $this->model_obj->setRow('positions', $data);
        }
    }
    private function salaryTypesToDb(object $salaryTypes): void
    {
        foreach ($salaryTypes as $k => $salaryType) {
            $data = [
                'title' => (string) $salaryType->title,
            ];
            $salaryType = $this->model_obj->setRow('salary_type', $data);
        }
    }
}
