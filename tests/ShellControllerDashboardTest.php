<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use App\Http\Controllers\ShellController;


class ShellControllerTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testShellControllerApplicationsReturnJson()
    {

        $this->testAuthLoginExample();

        $this->visit('/applications')
            ->seeJson(['errors' => null]);

    }

    public function testLoginToShell()
    {

        $this->testAuthLoginExample();

        $this->seePageIs('/dashboard');

    }


    public function testAuthLoginExample()
    {
        Auth::logout();

        $this->visit('/auth/login')
            ->type('ethan', 'username')
            ->type('EDI12', 'password')
            ->press('Login');
    }



}
