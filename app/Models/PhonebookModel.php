<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhonebookModel extends Model
{
    protected $table = 'phonebook';
    protected $fillable = [
        'username','phone', 'email','name'
    ];
}
