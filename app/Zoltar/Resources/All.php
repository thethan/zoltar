<?php
namespace App\Zoltar\Resources;

use App\Zoltar\Resources\Model;

trait All {

    public function all()
    {
        $this->getMethod();
        return $this->makeAWish();
    }

}