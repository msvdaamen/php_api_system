<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 14:45
 */

namespace App\router;

use App\router;

class RouterHandle
{
    private $url;
    private $class;
    private $function;
    private $request;


    public function __construct(string $url, string $controller, string $type) {
        $type === 'GET' ? $this->url = $this->parseUrl($url) : $this->url = $url;
        $this->request = new Request($type, $this->getUrlValues($url));
        $splitted = explode('@', $controller);
        $class = 'App\Controllers\\' . $splitted[0];
        $this->class = new $class();
        $this->function = $splitted[1];
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function handle() {
        if(method_exists($this->class, $this->function)) {
            echo $this->class->{$this->function}($this->request);
        }else {
            echo Response::response(['error' => 'function does not exist on ' . get_class($this->class)], 500);
        }
    }

    private function parseUrl($url): string {
        $splittedUrl = explode('/', $url);
        $newUrl = '';
        foreach ($splittedUrl as $partUrl) {
            if($partUrl !== '') {
                if($partUrl[0] === '{' && $partUrl[strlen($partUrl) - 1] === '}') {
                    $newUrl.= '/VALUE';
                    continue;
                }
                $newUrl .= '/' . $partUrl;
            }
        }
        return $newUrl;
    }

    private function getUrlValues($url): array {
        $data = [];
        $splittedUrl = explode('/', $url);
        $splittedServerUrl = explode('/', $_SERVER['REQUEST_URI']);
        if(sizeof($splittedUrl) === sizeof($splittedServerUrl)) {
            for($i = 0; $i < sizeof($splittedUrl); $i++) {
                if($splittedUrl[$i] === $splittedServerUrl[$i]) {
                    continue;
                } else {
                    if($splittedUrl[$i][0] === '{' && $splittedUrl[$i][strlen($splittedUrl[$i]) - 1] === '}') {
                        $data[substr($splittedUrl[$i], 1, strlen($splittedUrl[$i]) - 2)] = $splittedServerUrl[$i];
                    }
                }
            }
        }
        return $data;
    }

}