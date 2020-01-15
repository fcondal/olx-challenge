<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageTransformer extends JsonResource
{
    public function toArray($request)
    {
        return [
            'message' => $this["message"],
        ];
    }

}
