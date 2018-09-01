<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 15:35
 */

namespace App\Controllers;


use App\router\Response;

class TestController extends Controller
{
    public function test() {
        return Response::response('test', 200);
    }
}