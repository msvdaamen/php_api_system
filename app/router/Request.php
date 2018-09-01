<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 16:32
 */

namespace App\router;


use App\exeptions\ServerExeption;
use Exception;

class Request
{

    private $data;

    public function __get($varName){

        if($this->data) {
            if (!array_key_exists($varName,$this->data)){
                //this attribute is not defined!
            }
            else return $this->data[$varName];
        }
    }

    public function __construct(string $type, array $data = null)
    {
        switch ($type) {
            case 'GET' : {
                $this->data = $data;
                break;
            } case 'POST' : {
                $this->data = $_POST;
                break;
            }case 'PUT' : {
                parse_str(file_get_contents("php://input"),$this->data);
                break;
            }case 'DELETE' : {
            $this->data = $data;
            break;
            }
        }
    }

    public function getHeader(string $header = null) {
        if($header) {
            try {
                if(array_key_exists($header ,apache_request_headers())) {
                    return apache_request_headers()[$header];
                } else {
                    throw new ServerExeption('header does not exist');
                }
            } catch (ServerExeption $e) {
                die();
            }
        } else {
            return apache_request_headers();
        }
    }
}