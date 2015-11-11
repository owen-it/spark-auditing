<?php namespace App;

use Laravel\Cashier\Billable;
use Laravel\Spark\Teams\CanJoinTeams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laravel\Cashier\Contracts\Billable as BillableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Spark\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatable;
use Laravel\Spark\Contracts\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatableContract;
use OwenIt\Auditing\Auditing;

class User extends Auditing implements AuthorizableContract,
    BillableContract,
    CanResetPasswordContract,
    TwoFactorAuthenticatableContract
{
    use Authorizable, Billable, CanJoinTeams, CanResetPassword, TwoFactorAuthenticatable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'using_two_factor_auth',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'two_factor_options',
        'stripe_id', 'stripe_subscription', 'last_four', 'extra_billing_info',
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'trial_ends_at', 'subscription_ends_at',
    ];

    /**
     * @var string
     */
    public static $logCustomMessage = 'User {new.name|empty} {type} ';

    /**
     * @var array
     */
    public static $logCustomFields = [
        'name'  => 'The name was defined as {new.name}',
        'email'  => 'The email was defined as {new.email}',
        'phone_number' => 'The phone number was defined as {new.phone_country_code} {new.phone_number}',
    ];
}
