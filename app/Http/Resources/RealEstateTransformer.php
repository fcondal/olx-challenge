<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RealEstateTransformer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'titulo' => $this->title,
            'descripcion' => $this->description,
            'tipo_propiedad' => $this->kind->name,
            'estado' => $this->status->name,
            'tipo_operacion' => $this->operationType->name,
            'precio_minimo' => $this->min_price,
            'precio_maximo' => $this->max_price,
        ];
    }
}
