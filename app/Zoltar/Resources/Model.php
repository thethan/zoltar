<?php

namespace App\Zoltar\Resources;

use App\Zoltar\Zoltar;
use GuzzleHttp\Psr7\Response;

class Model
{
    use All;

    protected $service;

    protected $method;

    protected $class;

    protected $headers;

    protected $uri;

    protected $wish;

    protected $ticket;

    protected $body;

    public $status, $errors;

    /**
     * Primary Identifier to determine if the key exists or not.
     * @var
     */
    protected $primaryIdentifier = "Id";

    /**
     * @var array containing the existing
     */
    protected $parameters;


    public function __construct(\stdClass $class)
    {
        $this->$class = $class;
        $this->status = 400;
        $this->body = null;
        $this->errors = null;

    }


    protected function getMethod()
    {
        $this->method = 'GET';
    }

    protected function setPrimaryIdentifier($id)
    {
        $this->parameters[$this->primaryIdentifier] = $id;
    }

    protected function setParameters($parameter, $id)
    {
        $this->parameters[$parameter] = $id;
    }



    public static function find($id)
    {
        Model::setPrimaryIdentifier($id);
        Model::getMethod();


    }

    /**
     * @param $parameter
     * @param $id
     * @todo add opperators ('=', '<','>','>=','<=')
     */
    public static function where($parameter,$id)
    {
        Model::setParameters($parameter,$id);
    }

    public function save($class)
    {
        if(isset($this->$class->{$this->primaryIdentifier})){
            $this->method = 'PUT';
        } else {
            $this->method = 'POST';
        }

        $this->makeAWish();

    }

    /**
     * Speak to the Allmighty Zoltar
     *
     * Initiate the Service Call
     */
    private function makeAWish()
    {
        $zoltar = new Zoltar($this->service, $this->uri, $this->method, $this->parameters, $this->headers);
        $response = $zoltar->speaks();

        $this->makeTicket($response);

        return $this->reviewDestiny();

    }


    private function makeTicket(Response $response)
    {
        $this->ticket = $response;
        $this->status = $response->getStatusCode();
    }

    private function getStatus()
    {
        return $this->ticket->getStatusCode();
    }

    private function readTicket()
    {
        return $this->ticket->getBody()->getContents();
    }

    private function setExpectations()
    {

        $class = $this->class;

        if($this->status === $this->wish){
            $this->bodyToClass();
        } else {
            $this->bodyToErrors();
        }
    }

    private function readErrors()
    {
        $errors = $this->readTicket();
        $errors = json_decode($errors);

        return $errors->message;
    }

    private function reviewTicket()
    {
        $ticket = json_decode($this->readTicket());
        $app = app();
        $obj = $app->make('stdClass');
        $obj->status = $this->status;
        $obj->errors = $this->errors;

        $obj->{$this->class} = $ticket->{$this->class};

        return $obj;

    }

    private function bodyToClass()
    {

        $class = $this->class;
        $this->$class = $this->body;

    }

    private function bodyToErrors()
    {
        $this->readErrors();
        $this->errors = $this->readTicket();;

    }

    private function reviewDestiny()
    {

        $this->setExpectations();
        return $this->reviewTicket();
    }
}