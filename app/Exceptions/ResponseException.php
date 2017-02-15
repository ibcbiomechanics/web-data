<?php
/**
 * Created by PhpStorm.
 * User: i5
 * Date: 17/11/2016
 * Time: 17:54
 */

namespace App\Exceptions;


class ResponseException extends \Exception
{
    private $response;

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

}