<?php
namespace App\Zoltar\Resources;


trait Authenticate {

    public function authenticate($credentials)
    {
        return $this->makeAWish();
    }

}