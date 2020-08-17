<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musertestjawab extends Model
{
    protected $table = 'usertest_jawab';
    protected $fillable = ['id_user', 'id_soal', 'category', 'point'];
}
