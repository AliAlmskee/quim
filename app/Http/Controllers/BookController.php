<?php
// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $books = Book::all();
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request): BookResource
    {
        $book = Book::create($request->validated());

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): BookResource
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): BookResource
    {
        $request->validate([
            'name' => 'required|string',
            'photo' => 'required|string',
        ]);

        $book->name = $request->input('name');
        $book->photo = $request->input('photo');
        $book->save();

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }


    public function attachHadith(Request $request, Book $book)
    {
        $request->validate([
            'hadith_id' => 'required|integer|exists:hadiths,id',
        ]);

        $hadithId = $request->input('hadith_id');

        if ($book->hadiths()->where('hadith_id', $hadithId)->exists()) {
            return response()->json(['error' => 'Hadith already attached!'], 422);
        }

        $book->hadiths()->attach($hadithId);
        return response()->json(['message' => 'Hadith attached successfully!'], 200);
    }

    public function detachHadith(Request $request, Book $book)
    {
        $request->validate([
            'hadith_id' => 'required|integer|exists:hadiths,id',
        ]);

        $hadithId = $request->input('hadith_id');

        if (!$book->hadiths()->where('hadith_id', $hadithId)->exists()) {
            return response()->json(['error' => 'Hadith not attached!'], 404);
        }

        $book->hadiths()->detach($hadithId);
        return response()->json(['message' => 'Hadith detached successfully!'], 200);
    }
}
