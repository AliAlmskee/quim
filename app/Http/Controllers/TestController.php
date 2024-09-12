<?php
// app/Http/Controllers/TestController.php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Http\Resources\TestResource;
use App\Models\Center;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $tests = Test::all();
        return TestResource::collection($tests);
    }

    public function store(TestRequest $request): TestResource
    {
        $center = Center::find(Auth::user()->center_id);
        $request->merge(['points_added' => $request->mark * $center->points_factor * 0.1]);
        $requestData = $request->validated();
        $requestData['points_added'] = $request->input('points_added'); 
        $test = Test::create($requestData);
        return new TestResource($test);
    }

    public function show(Test $test): TestResource
    {
        return new TestResource($test);
    }

    public function update(TestRequest $request, Test $test): TestResource
    {
        $test->update($request->validated());
        return new TestResource($test);
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return response()->json(['message' => 'Test deleted successfully']);
    }
}
