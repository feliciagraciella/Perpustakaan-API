<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    //

    public function show($id)
    {
        $image = Book::find($id)->bookCover; // Replace YourModel with your actual model
        return response($image)->header('Content-Type', 'image/jpg');

        // return response($file, 200)->header('Content-Type', $contentType); // Adjust the content type based on your file type.
    }

}
