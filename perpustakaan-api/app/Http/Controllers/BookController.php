<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    public function index() {
        $books = Book::all();

        // return response()->json(['data' => $products]);
        return BookResource::collection($books); 
    }

    public function show($id) {
        $book = Book::findOrFail($id);

        // return response()->json(['data' => $product]);
        return new BookResource($book); 
    }

    // public function insertBook(Request $request) {
    //     $request->validate([
    //         'pName' => 'required|max:50',
    //         'pDescription' => 'max:255',
    //         'pQuantity' => 'required|min:0',
    //         'pPrice' => 'required|min:1'
    //     ]);

    //     if ($request->pPhoto) {
    //         $fileName = Str::random(25);
    //         $extension = $request->pPhoto->extension();

    //         Storage::putFileAs('image', $request->pPhoto, $fileName.'.'.$extension);

    //         $request['pPhoto'] = $fileName . '.' . $extension;
    //     }

    //     DB::table('products')->insert([
    //         'pName' => $request->pName,
    //         'pDescription' => $request->pDescription,
    //         'pQuantity' => $request->pQuantity,
    //         'pPrice' => $request->pPrice,
    //         'pPhoto' => $fileName . '.' . $extension,
    //         'created_at' => now(),
    //         'updated_at' => now()
    //     ]);

    //     // return new ProductResource($product);
    //     return 'success';
    // }

    public function updateBook(Request $request, $id) {
        $validated = $request->validate([
            'bookTitle' => 'required|max:100',
            'availableStatus' => 'required',
            'bookWriter' => 'required',
            'bookOverview' => 'required',
            'bookCover' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);
    
        $product = Book::findOrFail($id);
    
        if ($request->hasFile('bookCover')) {
            // $image = $request->file('bookCover');
            $path = $request->file('bookCover')->getRealPath();
            $logo = file_get_contents($path);
            $base64 = base64_encode($logo);
            $product->bookCover = $base64;

            $product->update([
                'bookTitle' => $request->bookTitle,
                'bookCover' => $base64,
                'bookWriter' => $request->bookWriter,
                'bookOverview' => $request->bookOverview,
                'availableStatus' => $request->availableStatus,
                'updated_at' => now(),
            ]);
            return 'Successfully updated';
        } else {
            $product->update([
                'bookTitle' => $request->bookTitle,
                'bookWriter' => $request->bookWriter,
                'bookOverview' => $request->bookOverview,
                'availableStatus' => $request->availableStatus,
                'updated_at' => now(),
            ]);

            return 'Successfully updated';
        }
    }
}
