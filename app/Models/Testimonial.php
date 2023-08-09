<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Testimonial
 * @package App\Models
 * @version September 4, 2022, 12:09 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $testimonialTranslations
 * @property string $name
 * @property string $job
 * @property string $description
 * @property integer $order_by
 * @property boolean $is_active
 */
class Testimonial extends Model
{
    use SoftDeletes;
    use Translatable;
    use HasFactory;

    public $table = 'testimonials';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $translatedAttributes = [
        'name',
        'job',
        'description',
    ];

    public $fillable = [
        'image',
        'name',
        'job',
        'description',
        'order_by',
        'is_active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'string',
        'name' => 'string',
        'job' => 'string',
        'description' => 'string',
        'order_by' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required|image|mimes:jpeg,jpg,png',
        'en.name' => 'required|string|min:4|max:250',
        'ar.name' => 'required|string|min:4|max:250',
        'en.job' => 'nullable|string|max:255',
        'ar.job' => 'nullable|string|max:255',
        'en.description' => 'nullable|string|max:700',
        'ar.description' => 'nullable|string|max:700',
        'order_by' => 'nullable|integer',
        'is_active' => 'required|boolean',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public static $update_rules = [
        'image' => 'nullable|image', // mimes:jpeg,jpg,png
        'en.name' => 'required|string|min:4|max:250',
        'ar.name' => 'required|string|min:4|max:250',
        'en.job' => 'nullable|string|max:255',
        'ar.job' => 'nullable|string|max:255',
        'en.description' => 'nullable|string|max:700',
        'ar.description' => 'nullable|string|max:700',
        'order_by' => 'nullable|integer',
        'is_active' => 'required|boolean',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function testimonialTranslations()
    {
        return $this->hasMany(\App\Models\TestimonialTranslation::class, 'testimonial_id');
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
