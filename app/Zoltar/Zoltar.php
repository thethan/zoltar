<?php

namespace App\Zoltar;

use App;
use Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation;


class Zoltar implements ServiceInterface
{

    use GetResponseBody, GetResponseStatus;
    /**
     * @var Method to talk to the server
     */
    public $method;

    /**
     * @var url To Service
     */
    public $url;

    /**
     * @param version
     */
    public $version = 1;

    /**
     * @var
     */
    public $response;


    protected $headers;

    /**
     * Build the URL and set the parameters for run
     * @param $uri
     * @param $method
     * @param array $parameters
     */
    public function __construct($service, $uri, $method, $parameters = array(), $headers)
    {

        $this->headers = $headers;
        $this->method = $method;
        $url = "http://".config(
                App::environment().'.service.base').config('service.'.$service)."srv.edudyn.com";
        $this->url = $url.$uri;
        if(!empty($parameters)){
            $this->updateUrl($parameters);
        }
    }

    /**
     * Update the Uri to be the
     * @param $parameters
     */
    protected function updateUrl($parameters)
    {
        foreach($parameters as $key => $value){
            $this->url = str_replace("[::$key::]", $value,$this->url);
        }
    }

    /**
     * Get the headers
     * @return array
     */
    protected function setHeader()
    {
        $return = array();
        $return['Content-Type'] = 'application/json';
        foreach($this->headers as $key => $value){

            $return[$value] = Auth::user()->$value;
        }

        return $return;
    }

    /**
     * Run the service based on GuzzleHttp
     */
    public function speaks()
    {
        $client = new Client();
        $request = new Request($this->method, $this->url, $this->setHeader(), array());
        $response =  $client->send($request);

        return $response;
    }


    public function printTicket(Response $response)
    {
        $this->response = $response;
        $this->status = $response->getStatusCode();
        

        return json($this->response->getBody()->getContents());
    }
}