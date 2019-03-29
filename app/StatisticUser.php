<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticUser extends Model
{
    protected $fillable = ['total', 'today', 'date'];

    public $timestamps = false;
}
