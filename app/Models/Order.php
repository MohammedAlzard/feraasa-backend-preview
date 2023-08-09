<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Order
 * @package App\Models
 * @version September 11, 2022, 10:53 am UTC
 *
 * @property \App\Models\Service $service
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $orderServiceFields
 * @property \Illuminate\Database\Eloquent\Collection $payments
 * @property integer $service_id
 * @property integer $user_id
 * @property string $order_number
 * @property string $status
 * @property number $discount
 * @property number $total
 */
class Order extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'orders';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'subscription_id',
        'service_id',
        'user_id',
        'order_number',
        'status',
        'discount',
        'total',
        'service_title',
        'is_agree_terms_and_conditions',
        'is_active_image',
        'language',
        'your_image',
        'other_image',
        'your_field1',
        'your_field2',
        'your_field3',
        'your_field4',
        'your_size1',
        'your_size2',
        'your_size3',
        'your_size4',
        'other_field1',
        'other_field2',
        'other_field3',
        'other_field4',
        'other_size1',
        'other_size2',
        'other_size3',
        'other_size4',
        'match_ratio',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subscription_id' => 'integer',
        'service_id' => 'integer',
        'user_id' => 'integer',
        'order_number' => 'string',
        'status' => 'string',
        'discount' => 'float',
        'total' => 'float',
        'service_title' => 'string',
        'is_agree_terms_and_conditions' => 'integer',
        'is_active_image' => 'integer',
        'language' => 'string',
        'your_image' => 'string',
        'other_image' => 'string',
        'your_field1' => 'string',
        'your_field2' => 'string',
        'your_field3' => 'string',
        'your_field4' => 'string',
        'your_size1' => 'string',
        'your_size2' => 'string',
        'your_size3' => 'string',
        'your_size4' => 'string',
        'other_field1' => 'string',
        'other_field2' => 'string',
        'other_field3' => 'string',
        'other_field4' => 'string',
        'other_size1' => 'string',
        'other_size2' => 'string',
        'other_size3' => 'string',
        'other_size4' => 'string',
        'match_ratio' => 'integer',
        'description' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'service_id' => 'required',
//        'user_id' => 'required',
//        'order_number' => 'nullable|string|max:255',
        'status' => 'required|string|in:On_Hold,Done',
//        'is_active_image' => 'required|string|in:1,0',
        'language' => 'required|string|in:ar,en',
//        'discount' => 'nullable|numeric',
//        'total' => 'nullable|numeric',
//        'service_title' => 'nullable|string',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class, 'service_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function orderServiceFields()
    {
        return $this->hasMany(\App\Models\OrderServiceField::class, 'order_id');
    }

    public function orderServiceField()
    {
        return $this->hasOne(\App\Models\OrderServiceField::class, 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class, 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(\App\Models\Payment::class, 'order_id');
    }

    public function review() {
        return $this->hasOne(\App\Models\Review::class, 'order_id');
    }

    public function answer()
    {
        return $this->hasOne(\App\Models\OrderAnswer::class, 'order_id');
    }
}
