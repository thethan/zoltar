<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    public $timestamps = false;

    protected $table = 'persons';

    protected $primaryIdentifier = 'PersonId';

    protected $fillable = ['PersonId', 'ClientId', 'RoleId'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
