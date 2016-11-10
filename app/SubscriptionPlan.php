<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $table = 'subscription_plans';
    const MAIN_SUBSCRIPTION = 'main';


    public function subscribers()
    {
        return $this->hasMany('App\User', 'id', 'plan_id');
    }


    public function limit()
    {
        return $this->hasOne('App\PlanLimit', 'plan_id');
    }
}
