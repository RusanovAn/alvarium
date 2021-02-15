<?php

namespace core;

class View
{

    public $controller;
    public $view;
    public $layout;
    private $route;

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        $this->controller = $route['Controller'];
        $this->view = $view;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) {
            extract($data);
        }
        $viewfile = ROOT . "/app/views/{$this->controller}/{$this->view}.php";
        if (!is_file($viewfile)) {
            $viewfile =  ROOT . "/app/views/Default/index.php";
        }
        if (is_file($viewfile)) {
            ob_start();
            require_once $viewfile;
            $content = ob_get_clean();
        } else {
            throw new \Exception("Вид {$viewfile} не найден", 500);
        }
        if (false !== $this->layout) {
            $layoutFile = ROOT . "/app/views/Layouts/{$this->layout}.php";
            if (is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new \Exception("Шаблон {$layoutFile} не найден", 500);
            }
        }
    }
}
