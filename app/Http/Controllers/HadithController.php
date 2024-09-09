<?php
namespace App\Http\Controllers;

use App\Services\AudioService;
use Illuminate\Http\Request;
use App\Http\Resources\HadithResource;
use App\Models\Hadith;

class HadithController extends Controller
{


    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $hadiths = Hadith::all();
        return HadithResource::collection($hadiths);
    }


    public function store(Request $request): HadithResource
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string',
            'order' => 'required|string|max:255',
        ]);

        $hadith = new Hadith();
        $hadith->name = $request->input('name');
        $hadith->text = $request->input('text');
        $hadith->order = $request->input('order');
        $hadith->save();
        return new HadithResource($hadith);
    }


    public function show($id): HadithResource
    {
        $hadith = Hadith::find($id);
        return new HadithResource($hadith);
    }


    public function update(Request $request, $id): HadithResource
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string',
            'order' => 'required|integer',
        ]);

        $hadith = Hadith::find($id);
        $hadith->name = $request->input('name');
        $hadith->text = $request->input('text');
        $hadith->order = $request->input('order');
        $hadith->save();
        return new HadithResource($hadith);
    }


    public function destroy($id)
    {
        $hadith = Hadith::find($id);
        $hadith->delete();
        return response()->json(null, 204);
    }


}
