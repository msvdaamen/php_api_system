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

    /**
     * adds a get request to the api
     *
     * @param string $url
     * @param string $controller
     */
    public static function get(string $url, string $controller) {
        array_push(self::$getRoutes, new RouterHandle($url, $controller, 'GET'));
    }

    /**
     * adds a post request to the api
     *
     * @param string $url
     * @param string $controller
     */
    public static function post(string $url, string $controller) {
        array_push(self::$postRoutes, new RouterHandle($url, $controller, 'POST'));
    }

    /**
     * adds a put request to the api
     *
     * @param string $url
     * @param string $controller
     */
//    public static function put(string $url, string $controller) {
//        array_push(self::$putRoutes, new RouterHandle($url, $controller, 'PUT'));
//    }

    /**
     * adds a delete request to the api
     *
     * @param string $url
     * @param string $controller
     */
//    public static function delete(string $url, string $controller) {
//        array_push(self::$deleteRoutes, new RouterHandle($url, $controller,'DELETE'));
//    }

    /**
     * handles the incoming request from a client
     */
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


    /**
     * looks if the request exists and then executes
     *
     * @param array $array
     */
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

    /**
     * checks if the url that is requested valid is
     *
     * @param $url
     * @return bool
     */
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