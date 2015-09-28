<?php

namespace App\StudentTrac\Shell;

use App\Shell\Resources\VOs\Applications;
use App\Zoltar\Resources\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    protected $class = 'Applications';

    protected $service = 'Application';

    protected $headers = array(
        'AuthenticationToken' => null,
        'SessionToken'  => null,
    );



    public function all()
    {
        $this->wish = 200;
        $this->classObj = '\App\StudentTrac\Shell\Resources\VOs\Applications';
        $this->classname = 'Applications';
        $this->method = 'GET';
        $this->uri = '/application';
        $response = parent::all();

        return $response;

    }


}
