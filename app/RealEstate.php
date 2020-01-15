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
        'title', 'description', 'status_id', 'kind','operation_type_id', 'min_price', 'max_price'
    ];

    public $timestamps = false;
    protected $table = 'real_estate';

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function operationType()
    {
        return $this->belongsTo('App\OperationType');
    }

    public function kind()
    {
        return $this->belongsTo('App\Kind');
    }

    public static function scopeSearch($query, $searchTerm)
    {
        if(isset($searchTerm['tipo_propiedad']))
            $query->where('kind_id', $searchTerm['tipo_propiedad']);

        if(isset($searchTerm['tipo_operacion']))
            $query->where('operation_type_id', $searchTerm['tipo_operacion']);

        if(isset($searchTerm['precio_desde']))
            $query->where('min_price', '>=',$searchTerm['precio_desde']);

        if(isset($searchTerm['precio_hasta']))
            $query->where('max_price', '<=',$searchTerm['precio_hasta']);

        if(isset($searchTerm['texto_libre'])){
            $query->where('title', 'LIKE','%'.$searchTerm['texto_libre'].'%');
            $query->orWhere('description', 'LIKE','%'.$searchTerm['texto_libre'].'%');
        }

        return $query;
    }

}
