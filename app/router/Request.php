<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 16:32
 */

namespace App\Router;


use App\Exeptions\ServerExeption;

class Request
{

    private $data;

    /**
     * gets the data from request
     *
     * @param string $varName
     * @return mixed
     */
    public function __get(string $varName){

        try {
            if($this->data) {
                if (array_key_exists($varName,$this->data)){
                   return $this->data[$varName];
                }
            }
            throw new ServerExeption('Request property ' . $varName . ' does not exist');
        }catch (ServerExeption $e) {
            die();
        }
    }

    /**
     * Request constructor.
     * @param string $type
     * @param array|null $data
     */
    public function __construct(string $type, array $data = null)
    {
        try {
            switch ($type) {
                case 'GET' : {
                    $this->data = $data;
                    break;
                } case 'POST' :
                {
                    $this->data = $_POST;
                    break;
                }
//            case 'PUT' : {
//                parse_str(file_get_contents("php://input"),$this->data);
//                dd($this->data);
//                break;
//            }case 'DELETE' : {
//                $this->data = $data;
//                break;
//            }
                default : {
                    throw new ServerExeption('Unsupported request type');
                }
            }
        } catch (ServerExeption $e) {
            die();
        }
    }

    /**
     * gets the header by name or get all headers if name is not specified
     *
     * @param string|null $header
     * @return array|false
     */
    public function getHeader(string $header = null) {
        if($header) {
            try {
                if(array_key_exists($header , apache_request_headers())) {
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