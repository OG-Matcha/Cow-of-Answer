<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books, 200);
        
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        if (Book::where('answer', $request->answer)
            ->exists()
        ) {
            return response()->json(['error' => '此答案已存在'], 409);
        }

        $book = Book::create($request->all());
        return response()->json($book, 201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $randomBookAnswer = Book::inRandomOrder()->first();

        if (!$randomBookAnswer) {
            return response()->json(['error' => '找不到資料'], 404);
        }

        return response()->json($randomBookAnswer, 200);
    }

    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($book_id)
    {
        $book = Book::find($book_id);

        if (!$book) {
            return response()->json(['error' => '找不到資料'], 404);
        }

        $book->delete();
        return response()->json(null, 204);
    }
}
