<?php

namespace App\Zoltar\Resources;


/**
 * Class ReturnResponse
 * @package App\Zoltar
 * Returns a response
 */
class ReturnResponse
{
    public $errors;

    public $status;









    public function ajaxResponse()
    {
        if ($this->status >= 400) {
            return (new Response(array($this->errors, $this->{$this->class}->$this->class), $this->status))
                ->header('Content-Type', 'application/json');
        }
        return new Response($this->{$this->class}, $this->status);
    }

    protected function setClassResponse($responseString)
    {
        $response = json_decode($responseString);
        $this->{$this->class} = $response->{$this->class};
    }
}