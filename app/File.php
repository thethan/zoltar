<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Zoltar\Resources\Model;


class File extends Model
{

    protected $service = 'Files';

    protected $class = 'DigitalFile';

    protected $headers = array(
        'AuthenticationPersonId'
    );

    protected $wish = 200;

    public function __construct()
    {

    }

    public function allCategories(){
        $this->class = 'CategoryFolders';
        $this->uri = '/category';
        $response = parent::all();
        return $response->ajaxResponse();

    }

    public function allFiles($personId){

        $this->class = 'DigitalFiles';
        $this->uri = '/file?PersonId=[::personId::]';
        $this->parameters = ['personId' => $personId];
        $response = parent::all();
        return $response;

    }


}
