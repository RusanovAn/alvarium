<?php

/**
 * Клас ReportController описує методи роботи зі сторінкою звітів
*/

namespace app\controllers;

use app\models\EmployesModel;
use DOMAttr;
use DOMDocument;

class ImportController extends AppController
{

    public function indexAction()
    {
//        $this->generateXmlAction();
    }
    public function generateXmlAction()
    {
        for ($i = 1; $i<10; $i++) {
            $departments[$i] = 'Департамент_'.$i;
            $positions[$i] = 'Должность_'.$i;
        }

        $salary_type[1] = 'Почасовая';
        $salary_type[2] = 'Ставка';

        $emploers_rate = [];


        $dom = new DOMDocument();
            $dom->encoding = 'utf-8';
            $dom->xmlVersion = '1.0';
            $dom->formatOutput = true;

        $xml_file_name = ROOT.'/files/employees.xml';
            $root = $dom->createElement('Employers');
                    $movie_node = $dom->createElement('employer');
                    $attr_movie_id = new DOMAttr('employer_id', '5467');
                    $movie_node->setAttributeNode($attr_movie_id);
                $child_node_title = $dom->createElement('Title', 'The Campaign');
                    $movie_node->appendChild($child_node_title);
                    $child_node_year = $dom->createElement('Year', 2012);
                    $movie_node->appendChild($child_node_year);
                $child_node_genre = $dom->createElement('Genre', 'The Campaign');
                    $movie_node->appendChild($child_node_genre);
                    $child_node_ratings = $dom->createElement('Ratings', 6.2);
                    $movie_node->appendChild($child_node_ratings);
                $root->appendChild($movie_node);
            $dom->appendChild($root);
        $dom->save($xml_file_name);
        echo "$xml_file_name has been successfully created";
    }
    public function loadXmlAction()
    {

    }
    public function insertToDbAction()
    {

    }
    public function xmlToSql()
    {
        $xml = simplexml_load_file(ROOT.'/files/employees.xml');
        $list = $xml->record;
        for ($i = 0; $i < count($list); $i++) {
            $list[$i]->attributes()->man_no;
            $list[$i]->name;
            $list[$i]->position;
        }
    }

}
