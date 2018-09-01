<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 14:30
 */

namespace App\Router;

use App\router;

class Route
{
    private static $getRoutes = [];
    private static $postRoutes = [];
    private static $putRoutes = [];
    private static $deleteRoutes = [];

    public static function get(string $url, string $controller) {
        array_push(self::$getRoutes, new routerHandle($url, $controller, 'GET'));
    }

    public static function post(string $url, string $controller) {
        array_push(self::$postRoutes, new routerHandle($url, $controller, 'POST'));
    }

    public static function put(string $url, string $controller) {
        array_push(self::$postRoutes, new routerHandle($url, $controller, 'PUT'));
    }

    public static function delete(string $url, string $controller) {
        array_push(self::$postRoutes, new routerHandle($url, $controller,'DELETE'));
    }

    public function init() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET' : {
                $this->handleRequest(self::$getRoutes);
                break;
            }
            case 'POST' : {
                $this->handleRequest(self::$postRoutes);
                break;
            }
            case 'PUT' : {
                $this->handleRequest(self::$putRoutes);
                break;
            }
            case 'DELETE' : {
                $this->handleRequest(self::$deleteRoutes);
                break;
            }
            default: {
                echo Response::response(['error' => 'Request not found'], 404);
            }
        }
    }

    private function handleRequest(array $array) {
        $executed = false;
        foreach ($array as $request) {
            if($this->checkUrl($request->getUrl())) {
                $request->handle();
                $executed = true;
                break;
            }
        }
        if(!$executed) {
            echo Response::response(['error' => 'Request not found'], 404);
            die();
        }
    }

    private function checkUrl($url): bool {
        $splittedUrl = explode('/', $url);
        $splittedServerUrl = explode('/', $_SERVER['REQUEST_URI']);
        if(sizeof($splittedUrl) === sizeof($splittedServerUrl)) {
            for($i = 0; $i < sizeof($splittedUrl); $i++) {
                if($splittedUrl[$i] === $splittedServerUrl[$i] || $splittedUrl[$i] === 'VALUE') {
                    continue;
                } else {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

}