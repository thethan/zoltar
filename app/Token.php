<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $primaryKey = 'user_id';

    public $timestamps = false;
    //
    public $fillable = ['AuthenticationToken', 'SessionToken'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUser()
    {

    }

    private function getSessionToken($user_id)
    {
        return static::find($user_id)->user();
    }
}
