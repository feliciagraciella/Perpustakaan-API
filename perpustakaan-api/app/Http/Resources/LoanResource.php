<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'loanID' => $this->loanID,
            'memberName' => $this->member->memberName,
            'loanDate' => $this->loanDate,
            'returnDate' => $this->returnDate,
            'returnStatus' => $this->returnStatus,
            'bookCount' => $this->details->count()
       ];
    }
}
