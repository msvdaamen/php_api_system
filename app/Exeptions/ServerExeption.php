<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 17:36
 */

namespace App\Exeptions;


use App\router\Response;
use Exception;
use Throwable;

class ServerExeption extends Exception
{
   public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
   {
       parent::__construct($message, $code, $previous);
       echo Response::response(['error' => $message], 500);
   }
}