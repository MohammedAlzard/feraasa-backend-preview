<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Contact
 * @package App\Models
 * @version September 4, 2022, 9:51 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property boolean $is_read
 */
class Contact extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contacts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'subject' => 'string',
        'message' => 'string',
        'is_read' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'nullable|string|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
        'is_read' => 'nullable|boolean',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
