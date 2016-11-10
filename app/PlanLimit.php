<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanLimit extends Model
{
    protected $table = 'plan_limit';
    protected $fillable = ['plan_id', 'limit'];

}
