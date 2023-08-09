<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Coupon
 * @package App\Models
 * @version September 21, 2022, 11:14 am UTC
 *
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $uses
 * @property integer $max_uses
 * @property integer $max_uses_user
 * @property boolean $type
 * @property integer $discount_amount
 * @property boolean $is_fixed
 * @property string|\Carbon\Carbon $starts_at
 * @property string|\Carbon\Carbon $expires_at
 */
class Coupon extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'coupons';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'name',
        'description',
        'uses',
        'max_uses',
        'max_uses_user',
        'type',
        'discount_amount',
        'is_fixed',
        'starts_at',
        'expires_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
        'uses' => 'integer',
        'max_uses' => 'integer',
        'max_uses_user' => 'integer',
        'type' => 'boolean',
        'discount_amount' => 'integer',
        'is_fixed' => 'boolean',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'nullable|string|min:4|max:191|unique:coupons,code',
        'name' => 'required|string|max:191',
        'description' => 'nullable|string',
        'uses' => 'nullable|integer',
        'max_uses' => 'nullable|integer',
        'max_uses_user' => 'nullable|integer',
        'type' => 'nullable|boolean',
        'discount_amount' => 'required|integer',
        'is_fixed' => 'nullable|boolean',
        'starts_at' => 'required',
        'expires_at' => 'required',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public static $update_rules = [
//        'code' => 'required|string|min:4|max:191|unique:coupons,code'. $this->id,
        'name' => 'required|string|max:191',
        'description' => 'nullable|string',
        'uses' => 'nullable|integer',
        'max_uses' => 'nullable|integer',
        'max_uses_user' => 'nullable|integer',
        'type' => 'nullable|boolean',
        'discount_amount' => 'required|integer',
        'is_fixed' => 'nullable|boolean',
        'starts_at' => 'required',
        'expires_at' => 'required',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


    public function scopeMaxuses($query) {
        return $query->where('max_uses', '>', $this->id);
    }

//    public function userReachedMaximumUses(User $user)
//    {
//        if ($this->max_uses_user <= 0) {
//            return false;
//        }
//        return $this->orders()->where('user_id', $user->id)->count() < $this->max_uses_user;
//    }


}
