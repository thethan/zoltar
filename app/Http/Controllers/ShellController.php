<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\User;
use App\Http\Requests;
use App\StudentTrac\Shell\Application;

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
    public function auth($authId, $studentId)
    {
        $request =  new Auth();

        $user = User::findPersonId($authId);

        //if no user make one
        if(empty($user)){

            //Get User information from Old Isistrac Information
            $user = factory(User::class)->make();
            //Get the user
            $user->password = bcrypt('EDI12');
            $user->save();
            $user->persons->AuthenticationPersonId = $authId;
        }

        //log in the new user
        Auth::login($user);

        //initiate the File Model
        $file = new File();
        //get all files for User id
        $files = $file->allCategories($studentId);

        //returns content of the $files
        return $files->ajaxResponse();

    }

    public function index()
    {
        Auth::logout();
        //$user = Auth::loginUsingId(2);

        return view('welcome');
    }

    public function dashboard()
    {

        $applications = new Application();
        $apps = $applications->all();
//        return response()
//            ->json((array)$apps);
 //       $apps = $apps->Applications;
        return view('dashboard')
            ->with('apps', $apps->Applications);
    }


    public function applications()
    {
        $applications = new Application();
        $apps = $applications->all();
        return response()->json((array)$apps);
    }

}
