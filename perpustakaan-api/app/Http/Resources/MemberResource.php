<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    
        return [
            'memberID' => $this->memberID,
            'memberName' => $this->memberName,
            'loans' => $this->loans->filter(function ($loan) {
                return $loan->returnStatus == 0;
            })->count()
        ];
        // return parent::toArray($request);
    }
}
