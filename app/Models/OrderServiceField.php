<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderServiceField extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'order_service_fields';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'order_id',
        'your_image_1',
        'your_image_2',
        'your_image_3',
        'your_image_4',
        'your_image_5',
        'your_image_6',
        'your_image_7',
        'your_image_8',
        'your_image_9',

        'other_image_1',
        'other_image_2',
        'other_image_3',
        'other_image_4',
        'other_image_5',
        'other_image_6',
        'other_image_7',
        'other_image_8',
        'other_image_9',

        'dream_description',

        'is_agree_show_photo',

        'name',
        'gender',
        'age',
        'status',
        'other_name',
        'other_gender',
        'other_age',
        'other_status',
    ];
}
