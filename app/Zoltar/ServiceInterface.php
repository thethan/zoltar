<?php

namespace App\Zoltar;

interface ServiceInterface
{
    /**
     * Constructor make a
     *
     * @param $url string
     * @param $method string
     * @param $parameters array
     */
    public function __construct($service, $url, $method, $parameters, $header, $body);

    /**
     * Run the Service
     */




}
