<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'status_id', 'operation_type_id', 'min_price', 'max_price'
    ];

    public $timestamps = false;
}
