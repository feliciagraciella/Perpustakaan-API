<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $primaryKey = 'loanID';

    protected $fillable = [
        'memberID',
        'returnStatus'
    ];


    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'memberID', 'memberID');
    }

    public function details(): HasMany
    {
        return $this->hasMany(LoanDetail::class, 'loanID', 'loanID');
    }
}
