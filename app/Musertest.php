<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musertest extends Model
{
    protected $table = 'usertest';
    protected $fillable = ['nama', 'license', 'email'];
}
