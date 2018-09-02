<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 15:35
 */

namespace App\Controllers;


use App\router\Request;
use App\router\Response;

class TestController extends Controller
{
    public function test(Request $request) {
            return Response::response(['data' => 'test'], 200);
    }
}