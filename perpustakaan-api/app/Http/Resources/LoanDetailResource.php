<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanDetailResource extends JsonResource
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
            // 'memberName' => $this->member,
            'memberName' => [
                'memberID' => $this->member->memberID,
                'memberName' => $this->member->memberName,
                'loans' => $this->member->loans->where('returnStatus', 0)->count(),
            ],
            'details' => $this->details->map(function ($detail) {
                return [
                    'detailID' => $detail->detailID,
                    'loanID' => $detail->loanID,
                    'bookID' => $detail->bookID,
                    'bookTitle' => $detail->book->bookTitle,
                    'bookCover' => $detail->book->bookCover,
                    'actualReturnDate' => $detail->actualReturnDate,
                ];
            }),
            'returnDate' => $this->returnDate,
            'returnStatus' => $this->returnStatus
       ];
    }
}
