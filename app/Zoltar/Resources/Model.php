<?php

namespace App\Zoltar\Resources;

use App\Zoltar\Zoltar;
use GuzzleHttp\Psr7\Response;

class Model
{
    use All;

    /**
     * @var Service to be called.
     *
     */
    protected $service;
    /**
     * Simple method of the service
     * @var
     */
    protected $method;

    /**
     * service is expecting
     * @var
     */
    protected $class;
    /**
     * What needs to be called for this case of Authentication
     * @var
     */
    protected $headers;

    /**
     * Where the API is located
     * @var
     */
    protected $uri;

    protected $wish;

    protected $ticket;

    protected $body;

    /**
     * What needs to be returned
     * @var
     */
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
        $this->errors = null;

    }


    protected function getMethod()
    {
        $this->method = 'GET';
    }

    /**
     * Sets the primary Identifier based on how the model is set up
     * @param $id
     */
    protected function setPrimaryIdentifier($id)
    {
        $this->parameters[$this->primaryIdentifier] = $id;
    }

    /**
     * Sets the parameters of the where Query
     * @param $parameter
     * @param $id
     */
    protected function setParameters($parameter, $id)
    {
        $this->parameters[$parameter] = $id;
    }

    /**
     * Write the find method to get a specific identifier
     * @param $id
     */
    public static function find($id)
    {
        Model::setPrimaryIdentifier($id);
        Model::getMethod();


    }

    /**
     * Make a where function to easily search the database
     *
     * @param $parameter
     * @param $id
     * @todo add opperators ('=', '<','>','>=','<=')
     */
    public static function where($parameter,$id)
    {
        Model::setParameters($parameter,$id);
    }

    /**
     * Save either PUT or POST the information
     * @param $class
     */
    public function save($class)
    {
        if(isset($this->$class->{$this->primaryIdentifier})){
            $this->method = 'PUT';
        } else {
            $this->method = 'POST';
        }

        // call the service
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

    /**
     * set the Ticket and status to be used.
     * @param Response $response
     */
    private function makeTicket(Response $response)
    {
        $this->ticket = $response;
        $this->status = $response->getStatusCode();
    }

    /**
     * Get Body and Contents of the Ticket
     * @return mixed
     */
    private function readTicket()
    {
        return $this->ticket->getBody()->getContents();
    }

    /**
     * Check to see if you get the right response and then set the call's errors or body
     */
    private function setExpectations()
    {

        $class = $this->class;

        if($this->status === $this->wish){
            $this->bodyToClass();
        } else {
            $this->bodyToErrors();
        }
    }

    /**
     * If the request has errors they need to be set to the errors @param errors
     * @return mixed
     */
    private function readErrors()
    {
        $errors = $this->readTicket();
        $errors = json_decode($errors);

        return $errors->message;
    }

    /**
     * Make the whole ticket readable by for either a variable or an ajax call
     * @return ReturnResponse
     */
    private function reviewTicket()
    {
        $ticket = json_decode($this->readTicket());

        $obj = new ReturnResponse($this->class);
        $obj->status = $this->status;
        $obj->errors = $this->errors;

        $obj->{$this->class} = $ticket->{$this->class};

        return $obj;

    }

    /**
     * Turn the body into an error
     */
    private function bodyToErrors()
    {
        $this->readErrors();
        $this->errors = $this->readTicket();;

    }

    /**
     * Function that make things happen
     * @return ReturnResponse
     */
    private function reviewDestiny()
    {
        $this->setExpectations();
        return $this->reviewTicket();
    }

}