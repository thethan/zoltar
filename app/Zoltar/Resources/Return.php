<?php

namespace App\Zoltar;
use GuzzleHttp\Psr7\Response;


/**
 * Class ReturnResponse
 * @package App\Zoltar
 * Returns a response
 */
class ReturnResponse
{
    public $errors;

    public $static;

    public $class;

    public function __construct($className)
    {
        $this->class = $className;
    }

    protected function setClassResponse($responseString)
    {
        $response = json_decode($responseString);
        $this->{$this->class} = $response->{$this->class};
    }

    public function ajaxResponse()
    {}
}