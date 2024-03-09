<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use SoftDeletes;

    public $table = 'medications';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'code',
        'description',
        'intger',
        'created_by'
    ];

    protected $casts = [
        'name' => 'string',
        'code' => 'string',
        'description' => 'string',
        'quantity' => 'integer',
        'created_by' => 'integer'
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];
}
