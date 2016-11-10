<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'trial_ends_at', 'braintree_id', 'paypal_email', 'card_brand', 'card_last_four',
        'plan_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['trial_ends_at'];

    public function plan()
    {
        return $this->hasOne('App\SubscriptionPlan', 'id', 'plan_id');
    }

    public function jokes()
    {
        return $this->belongsToMany(\App\Jokes::class, 'users_jokes');
    }
}
