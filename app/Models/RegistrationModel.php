<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationModel extends Model
{
    protected $table ="registration";
    protected $timestamp =true;
    protected $fillable = [
        'first_name','last_name', 'city','username','gender','password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
