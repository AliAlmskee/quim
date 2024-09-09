<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CenterResource;
use App\Models\Center;

class CenterController extends Controller
{
    public function index()
    {
        $centers = Center::all();
        return CenterResource::collection($centers);
    }

    public function store(Request $request): CenterResource
    {
        $center = Center::create($request->all());
        return new CenterResource($center);
    }

    public function show($id): CenterResource
    {
        $center = Center::find($id);
        return new CenterResource($center);
    }

    public function update(Request $request, $id): CenterResource
    {
        $center = Center::find($id);
        $center->update($request->all());
        return new CenterResource($center);
    }

    public function destroy($id)
    {
        $center = Center::find($id);
        $center->delete();
        return response()->noContent();
    }

    public function attachBook(Request $request, Center $center)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
        ]);

        $bookId = $request->input('book_id');

        if ($center->books()->where('book_id', $bookId)->exists()) {
            return response()->json(['error' => 'Book already attached!'], 422);
        }

        $center->books()->attach($bookId);
        return response()->json(['message' => 'Book attached successfully!'], 200);
    }

    public function detachBook(Request $request, Center $center)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
        ]);

        $bookId = $request->input('book_id');

        if (!$center->books()->where('book_id', $bookId)->exists()) {
            return response()->json(['error' => 'Book not attached!'], 404);
        }

        $center->books()->detach($bookId);
        return response()->json(['message' => 'Book detached successfully!'], 200);
    }

}
