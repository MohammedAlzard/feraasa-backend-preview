<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAnswer extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'order_answers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'order_id',
        'image',
        'report_id',
    ];


    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

}
