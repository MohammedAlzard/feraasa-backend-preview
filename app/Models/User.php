<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Crypt;
use Laravel\Cashier\Billable;

/**
 * Class User
 * @package App\Models
 * @version September 7, 2022, 11:17 am UTC
 *
 * @property string $avatar
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $phone
 * @property string $email
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string|\Carbon\Carbon $last_logged_in
 * @property boolean $is_active
 * @property string $remember_token
 */
class User extends Authenticatable implements MustVerifyEmail
{

    use SoftDeletes, HasFactory, Notifiable, Billable;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'avatar', 'username', 'first_name', 'last_name', 'date_of_birth', 'phone', 'email', 'password', 'last_logged_in', 'is_active',
        'customer_id',
        'provider',
        'provider_id',
        'provider_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'avatar' => 'string',
        'username' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'date_of_birth' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'last_logged_in' => 'datetime',
        'is_active' => 'boolean',
        'remember_token' => 'string',
        'customer_id' => 'string',
        'provider' => 'string',
        'provider_id' => 'string',
        'provider_token' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'avatar' => 'nullable|image|mimes:jpeg,jpg,png',
        'username' => 'nullable|string|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|email|max:255',
//        'new_password' => 'required_if:old_password,!=,null|string|min:8|confirmed',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'customer_id' => 'nullable',
        'provider' => 'nullable',
        'provider_id' => 'nullable',
        'provider_token' => 'nullable',
    ];


    public function paymentMethod() {
        return $this->hasOne(PaymentMethod::class, 'user_id')->where('is_active', true);
    }

    public function setGoogleTokenProviderAttribute($value) {
        $this->attributes['google_token'] = Crypt::encrypt($value);
    }

    public function getGoogleTokenProviderAttribute($value) {
        $this->attributes['google_token'] = Crypt::decrypt($value);
    }

    public function subscribed($name = 'default', $price = null)
    {
        return $this->hasOne(Subscription::class);
    }
}
