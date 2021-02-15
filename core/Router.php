<?php

/**
 * Класс Router розбирає url введений користувачем на частини та в залежності від цих частин
 * викликає controller та його action
 *
 * Так як додаток використовує модель MVC, урл будується наступним чином:
 * домен.com/controller/action/?get_param1=value1&get_param2=value2
 * Де Controller відповідає за сутність (задача, довідник, логи і тд)
 * action відповідає за дію над сутністю. (CRUD)
 * додаткові get параметри
 *
 */

namespace core;

class Router
{
    public static function start($url)
    {
        /**Прибираємо лівий слеш переданого uri*/
        $url = ltrim($url, '/');

        /**Якщо урл містить GET параметри, оброблюємо їх*/
        if (isset($_GET) && !empty($_GET) && strpbrk($url, '?')) {
            $get = $_GET;
            /**Додаємо до массиву маршруту назви GET параметрів та їх значення*/
            foreach ($get as $k => $v) {
                /**Переводимо значення в нижній регістр та замінюємо тире на нижнє підкреслення*/
                $rout[$k] = str_replace('-', '_', strtolower($v));
            }
            /**Після обробки GET параметрів, видаляємо їх з url*/
            $url = substr($url, 0, strpos($url, '?'));
        }

        /**Розбиваємо урл в массив по слешу*/
        $url_array = explode('/', $url);

        /**
         * Нульовий елемент массиву відповідає за контроллер, приводимо його до страндарту PSR-4
         * Controller повинен починатися з великої букви, та в кінці мати приставку Controller
         */
        if (!empty($url_array[0])) {
            /** Controller повинен починатися з великої букви всі інші з маленької*/
            $rout['Controller'] = ucfirst(strtolower($url_array[0]));
        } else {
            /**Якщо контроллер не вказано, це вказує на головну сторінку
             * за замовчуванням головною сторінкою є звіт
             */
            $rout['Controller'] = 'Employes';
        }
        /**
         * Controller повинен в кінці мати приставку Controller
         * задаємо путь де знаходяться всі контроллери
         */
        $controller = 'app\controllers\\' . $rout['Controller'] . 'Controller';
        $action = 'indexAction';

        $rout['action'] = 'index';
        if (isset($url_array[1]) && !empty($url_array[1])) {
            /**записуємо в массив з маршрутом відформатований action*/
            $rout['department'] = $url_array[1];
        }
        /**Отриманний массив маршруту записуємо в константу*/
        define('ROUT', $rout);

        /**Створюємо єкземпляр контроллеру*/
        $controller_obj = new $controller($rout);
        /**Викликаємо його action який підготує данні та віддасть сторінці*/
        $controller_obj->$action();
        /**Формуємо сторінку для показу користувачу*/
        $controller_obj->getView();
    }

}
