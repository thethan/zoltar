<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigitalFile extends Model
{
    /**
     * Service to use in config auth. Will change based on the local environments.
     * @var string
     */
    protected $service = 'Files';

    protected $class = 'DigitalFile';

    /**
     * Act as the middleware that does not allow for the service to be used.
     *
     * @var array
     */
    protected $headers = array(
        'AuthenticationPersonId'
    );

    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function ListAllCategories(){
        $this->uri = '/category';
        return parent::all();
    }

    public function ListAllFiles($categoryId)
    {
        $this->uri = '/file';
    }

}