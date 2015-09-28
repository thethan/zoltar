<?php

namespace App\StudentTrac\DigitalFile\Resources\Model;

use App\Zoltar\Resources\Model;

class Category extends Model
{
    protected $headers = array(
        'AuthenticationPerson' => null,

    );

    public function all()
    {
        $this->wish = 200;
        $this->classObj = '\App\DigitalFile\Resources\VOs\Category';
        $this->classname = 'Categories';
        $this->method = 'GET';

        $this->uri = '/category';
        $response = parent::all();

        return $response;
    }
}
