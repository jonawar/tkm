<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musertype extends Model
{
    protected $table = 'type';
    protected $fillable = ['id', 'type', 'type_description', 'description'];
}
