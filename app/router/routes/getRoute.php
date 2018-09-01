<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 14:45
 */

namespace App\router\routes;
use App\Controllers\TestController;

class getRoute
{
    private $url;
    private $class;
    private $function;


    public function __construct(string $url, string $controller)
    {
        $this->url = $url;
        $splitted = explode('@', $controller);
        $class = 'App\Controllers\\' . $splitted[0];
        $this->class = new $class();
        $this->function = $splitted[1];
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function handle() {
        return $this->class->{$this->function}();
    }

}