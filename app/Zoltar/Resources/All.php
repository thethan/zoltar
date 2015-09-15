<?php
namespace App\Zoltar\Resources;


trait All {

    public function all()
    {
        $this->getMethod();
        return $this->makeAWish();
    }

}