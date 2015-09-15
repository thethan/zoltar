<?php

namespace App\Http\Controllers;


use App;
use Auth;
use App\User;
use App\Http\Requests;

use App\File;



class ShellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @todo break up into two responses
     * @todo break authentication into its own model
     *
     * @return Response
     */
    public function index($authId)
    {
        $request =  new Auth();

        $user = User::findPersonId($authId);

        //if no user make one
        if(empty($user)){
            $user = new App\User();
            //Get the user
            $user->name = 'Ethan';
            $user->email = 'ettoten@ofl.com';
            $user->password = bcrypt('edi12');
            $user->AuthenticationPersonId = 13448;
            $user->save();
        }

        //log in the new user
        Auth::login($user);

        //initiate the File Model
        $file = new File();
        //get all files for User id
        $files = $file->allFiles(336152);

        //returns content of the $files
        return $files->ajaxResponse();

    }


}
