<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanDetail extends Model
{
    use HasFactory;

    protected $table = 'loan_detail';
    protected $primaryKey = 'detailID';

    protected $fillable = [
        'bookID',
        'actualReturnDate'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'bookID', 'bookID');
    }
}
