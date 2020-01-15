<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorTransformer extends JsonResource
{
    public static $wrap = 'error';

    public function toArray($request)
    {
        return [
            'message' => $this["message"],
        ];
    }

}
