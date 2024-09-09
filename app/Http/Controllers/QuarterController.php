<?php
// app/Http/Controllers/QuarterController.php

namespace App\Http\Controllers;

use App\Http\Requests\QuarterRequest;
use App\Models\Quarter;
use Illuminate\Http\Request;

class QuarterController extends Controller
{
    public function index()
    {
        $quarters = Quarter::all();
        return response()->json($quarters);
    }

    public function store(QuarterRequest $request)
    {
        $quarter = Quarter::create($request->validated());
        return response()->json($quarter, 201);
    }

    public function show(Quarter $quarter)
    {
        return response()->json($quarter);
    }

    public function update(QuarterRequest $request, Quarter $quarter)
    {
        $quarter->update($request->validated());
        return response()->json($quarter);
    }

    public function destroy(Quarter $quarter)
    {
        $quarter->delete();
        return response()->json(null, 204);
    }
}
