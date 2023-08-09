<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialTranslation extends Model
{
    public $table = 'testimonial_translations';

    public $timestamps = false;
    protected $fillable = [
        'name',
        'job',
        'description',
    ];
}
