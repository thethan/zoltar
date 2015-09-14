<?php

namespace App\Zoltar;


trait GetResponseStatus
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getResponseStatus()
    {
        return $this->response->getStatusCode();
    }
}