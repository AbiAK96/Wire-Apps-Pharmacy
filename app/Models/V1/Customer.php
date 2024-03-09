<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use SoftDeletes;

    public $table = 'customers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'created_by'
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        'address' => 'string',
        'created_by' => 'intger'
    ];
}
