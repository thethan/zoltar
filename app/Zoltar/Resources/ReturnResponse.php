<?php

namespace App\Zoltar\Resources;
use Illuminate\Http\Response;


/**
 * Class ReturnResponse
 * @package App\Zoltar
 * Returns a response
 */
class ReturnResponse
{
    public $errors;

    public $status;

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
    {
        if($this->status >= 400){
            return ( new Response(array($this->errors, $this->{$this->class}->$this->class), $this->status))
                ->header('Content-Type', 'application/json');
        }
        return new Response($this->{$this->class},$this->status);
    }
}