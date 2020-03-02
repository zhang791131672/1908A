<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classify extends Model
{
    protected $table = 'cate';
    protected $primaryKey = 'c_id';
    public $timestamps = false;
    protected $guarded = [];
}
