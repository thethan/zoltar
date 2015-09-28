<?php

namespace App\Zoltar;

use App;
use Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;



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

    public $body;

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
    public function __construct($service, $uri, $method, $parameters = array(), $headers, $body)
    {
        $this->setHeader($headers);

        $this->method = $method;
        $this->body = json_encode($body);
        $url = config('service.protocol').config(
                App::environment().'.service.base').config('service.'.$service).config('service.url');
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
    protected function setHeader($headers)
    {

        if(is_array($headers)){
            $headers['Content-Type'] = 'application/json';
            $this->headers = $headers;
            return;
        }

        $this->headers = ['Content-Type' => 'application/json'];
        return;

    }

    /**
     * Run the service based on GuzzleHttp
     */
    public function speaks()
    {
        $client = new Client(['exceptions' => false]);
        $request = new Request($this->method, $this->url, $this->headers, $this->body);

        $response =  $client->send($request);

        return $response;
    }


}