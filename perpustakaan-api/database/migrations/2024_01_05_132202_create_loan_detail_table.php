<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_detail', function (Blueprint $table) {
            $table->id('detailID');
            $table->unsignedBigInteger('loanID');
            $table->unsignedBigInteger('bookID');
            $table->date('actualReturnDate');
            $table->timestamps();

            $table->foreign('loanID')->references('loanID')->on('loans');
            $table->foreign('bookID')->references('bookID')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_detail');
    }
};
