<?php

namespace App\Zoltar;

use GuzzleHttp\Psr7\Response;


trait GetResponseBody
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getResponseBody()
    {
        return $this->response->getBody()->getContents();
    }
}