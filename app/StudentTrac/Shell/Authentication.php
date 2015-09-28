<?php

namespace App\StudentTrac\Shell;

use App\Shell\Resources\VOs\AuthenticationPerson;
use App\Person;
use App\Token;
use App\User;
use App\Zoltar\Resources\Model;
use Illuminate\Support\Facades\Auth;

class Authentication extends Model
{
    protected $class = 'Authetnication';

    protected $service = 'Authentication';

    protected $headers = array(
        'AuthenticationToken' => null,
        'SessionToken' => null,
    );


    /**
     * @todo add Expored On To Tokens
     * @Todo add ClientId, RoleId, LanguageId to Persons
     * @param $credentials
     * @return string
     */
    public function authenticate($credentials)
    {
        $this->wish = 200;
        $this->classname = 'Person';
        $this->classObj =  '\App\StudentTrac\Shell\Resources\VOs\AuthenticationPerson';
        $this->method = 'PUT';
        $this->uri = '/authentication/v2/authentication';
        $this->body = $credentials;
        $response = parent::authenticate($credentials);
        $Person = $response;

        $user = Auth::user();


        $tokens = $user->tokens;

        $tokens->AuthenticationToken = $Person->AuthenticationToken;
        //$newTokens->SessionToken = $tokens->SessionToken;
        $user->tokens()->save($tokens);


        //Change when we have multiple users
//        $person = Person::findOrNew($Person->PersonId);
//
//        $person->PersonId = $Person->PersonId;
//        $person->RoleId = $Person->RoleId;
//        $person->ClientId = $Person->ClientId;
//
//        $user->persons()->save($person);

        return true;

    }


}
