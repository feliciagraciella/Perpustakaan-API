<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\LoanResource;
use App\Http\Resources\LoanDetailResource;

class LoanController extends Controller
{
    //
    public function index() {
        $loans = Loan::all();

        // return response()->json(['data' => $transactions]);
        return LoanResource::collection($loans); 
    }

    public function loanCreate(Request $request) {
        $request->validate([
            'details' => 'required|array|min:1',
            'details.*.bookID' => 'required|exists:books,bookID',
            'memberID' => 'required'
        ]);

        DB::table('loans')->insert([
            'memberID' => $request->memberID,
            'loanDate' => now(),
            'returnDate'=> now()->addDays(7),
            'returnStatus' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $loan = DB::table('loans')->latest()->first();
            

        foreach ($request->input('details') as $detail) {
            $product = Book::findOrFail($detail['bookID']);

            DB::table('books')
                ->updateOrInsert(
                    ['bookID' => $product->bookID],
                    ['availableStatus' => 0,
                    'updated_at' => now()]
                );
            

            DB::table('loan_detail')->insert([
                'loanID' => $loan->loanID,
                'bookID' => $detail['bookID'],
                'actualReturnDate' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return 'Success';
    }

    public function show($id) {
        $loan = Loan::with(['member:memberID,memberName', 'details:detailID,loanID,bookID,actualReturnDate'])->findOrFail($id);

        return new LoanDetailResource($loan); 
    }

    public function returnBook($loanId, $bookId) {
        try {
            DB::beginTransaction();
    
            $loan = Loan::findOrFail($loanId);
    
            $detail = $loan->details()->where('bookID', $bookId)->firstOrFail();
    
            $detail->update([
                'actualReturnDate' => now(),
            ]);

            $book = Book::findOrFail($bookId);

            $book->update([
                'availableStatus' => 1
            ]);
    
            $allBooksReturned = $loan->details()->whereNull('actualReturnDate')->count() == 0;
    
            $loan->update([
                'returnStatus' => $allBooksReturned ? 1 : 0,
            ]);
    
            DB::commit();
    
            return response()->json(['message' => 'Book returned successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json(['message' => 'Error returning book', 'error' => $e->getMessage()], 500);
        }
    }

}
