<?php

namespace core;

use Exception;

/**
 * Class Controller описує загальні методи всіх контроллерів
 * @package core
 */
class Controller
{
    /**
     * @var - массив з маршрутом сформованним в классі core\Router
     */
    public $route;
    /**
     * @var - Загальний шаблон сторінки (Хедер, футер, меню)
     */
    public $layout;
    /**
     * @var - тіло сторінки
     */
    public $view;
    /**
     * @var array - массив данних сформованих контролером для передачі в сторінку
     */
    public $data = [];

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->route = ROUT;
        $this->view = ROUT['action'];
    }

    /**
     * Функція записує массив данних для передачі на сторінку
     *
     * @param $data - массив данних для відображення на сторінці
     */
    public function set($data)
    {
        $this->data = $data;
    }

    /**
     *Створює обїект виду та рендеріт кінцеву сторінку
     *
     * @throws Exception
     */
    public function getView()
    {
        /**Для формування сторінки передаємо маршрут, шаблон, вид та данні для сторінки*/
        $viewObj = new View($this->route, $this->layout, $this->view);
        /**Виконуємо безпосередньо формування сторінки та віддаємо користувачу*/
        $viewObj->render($this->data);
    }

}
