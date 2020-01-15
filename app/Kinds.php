<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function realEstate()
    {
        return $this->hasMany('App\RealEstate');
    }

}
