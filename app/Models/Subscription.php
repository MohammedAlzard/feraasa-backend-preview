<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Subscription
 * @package App\Models
 * @version October 2, 2022, 11:12 am UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property integer $service_id
 * @property boolean $is_active
 * @property integer $count
 * @property integer $count_used
 * @property string $name
 * @property string $stripe_id
 * @property string $stripe_status
 * @property string $stripe_price
 * @property string $stripe_plan
 * @property integer $quantity
 * @property string|\Carbon\Carbon $trial_ends_at
 * @property string|\Carbon\Carbon $ends_at
 */
class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'subscriptions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'service_id',
        'is_active',
        'count',
        'count_used',
        'name',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'stripe_plan',
        'quantity',
        'trial_ends_at',
        'ends_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'service_id' => 'integer',
        'is_active' => 'boolean',
        'count' => 'integer',
        'count_used' => 'integer',
        'name' => 'string',
        'stripe_id' => 'string',
        'stripe_status' => 'string',
        'stripe_price' => 'string',
        'stripe_plan' => 'string',
        'quantity' => 'integer',
        'trial_ends_at' => 'datetime',
        'ends_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'service_id' => 'nullable',
        'is_active' => 'required|boolean',
        'count' => 'nullable|integer',
        'count_used' => 'nullable|integer',
        'name' => 'nullable|string|max:191',
        'stripe_id' => 'nullable|string|max:191',
        'stripe_status' => 'nullable|string|max:191',
        'stripe_price' => 'nullable|string|max:191',
        'stripe_plan' => 'nullable|string|max:191',
        'quantity' => 'nullable|integer',
        'trial_ends_at' => 'nullable',
        'ends_at' => 'nullable',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }


    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
