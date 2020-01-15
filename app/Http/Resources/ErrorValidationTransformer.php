<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorValidationTransformer extends JsonResource
{
    public static $wrap = 'error';

    public function withResponse($request, $response)
    {
        $response->setStatusCode(422);
    }

    public function toArray($request)
    {
        return [
            'message' => $this["message"],
            'errors' => $this["errors"]
        ];
    }
}
