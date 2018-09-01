<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 14:30
 */

namespace App\Router;

use App\router\routes\getRoute;

class Route
{
    private static $getRoutes = [];
    private $postRoutes = [];
    private $putRoutes = [];
    private $deleteRoutes = [];

    public static function get(string $url, string $controller) {
        array_push(self::$getRoutes, new getRoute($url, $controller));
    }

    public static function post() {

    }

    public static function put() {

    }

    public static function delete() {

    }

    public function init() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET' : {
                foreach (self::$getRoutes as $request) {
                    if($request->getUrl() == $_SERVER['REQUEST_URI']) {
                        echo $request->handle();
                        break;
                    }
                }
                break;
            }
            default: {
                return Response::response(['error' => ' osyiudgfoa'], 404);
            }
        }
    }

}