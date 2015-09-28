<?php
namespace App\Zoltar\Resources;
use Illuminate\Support\Facades\Auth;

trait SetUserHeaders {

    protected function setUserHeaders()
    {
        $user = Auth::user();

        $tokens = $user->tokens;
        $person = $user->persons;

        if (array_key_exists("AuthenticationToken", $this->headers)) {

            $this->headers['AuthenticationToken'] = $tokens->AuthenticationToken;
            $this->headers['SessionToken'] = $tokens->SessionToken;
        }

        if(array_key_exists("AuthenticationPersonId",$this->headers)){
            $this->headers['AuthenticationPersonId'] = $person[0];
        }

    }

}