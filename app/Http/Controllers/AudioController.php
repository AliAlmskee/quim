<?php

namespace App\Http\Controllers;

use App\Models\hadith;
use App\Services\AudioService;
use Illuminate\Http\Request;

class AudioController
{

    protected AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        $this->audioService = $audioService;
    }

    public function storeAudio(Request $request)
    {
        return $this->audioService->storeAudio($request);
    }

    public function getAudio($id)
    {
        return $this->audioService->getAudio($id);
    }

    public function attachAudioToHadith($audioId, $hadithId): void
    {
        $hadith = Hadith::findOrFail($hadithId);
        $hadith->audios()->attach($audioId);
    }
    public function storeHadithHint(Request $request)
    {
        $request->validate([
            'hadith_id' => 'required|exists:hadiths,id',
        ]);
        $audio = $this->storeAudio($request);
        $this->attachAudioToHadith($audio->id, $request->hadith_id);

        return response()->json(['message' => 'Hadith Attached successfully!', 'audio' => $audio->toArray()], 200);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|file|max:5000',
        ]);
    
        $file = $request->file('image');
        $newFileName = time() . '_' . $file->getClientOriginalName();
        $filePath = '';
    
        if (strpos($file->getMimeType(), 'image') === 0) {
            $file->move(public_path('images'), $newFileName);
            $filePath = $newFileName;
        } else {
            return response()->json('Uploaded file is not an image');
        }
    
        return response()->json(['file_path' => $filePath]);
    }

    public function getImage($filename)
{
    $imagePath = public_path('images/' . $filename);
  

    if (file_exists($imagePath)) {
        return response()->file($imagePath);
    }

    return response()->json(['error' => 'File not found'], 404);
}



}
