<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Audio;

class AudioService
{
    public function storeAudio(Request $request)
    {
        // Validate the request
        $request->validate([
            'audio' => 'required|file|mimes:mp3,wav,ogg|max:10240', // Max size 10MB
        ]);

        // Store the audio file
        $path = $request->file('audio')->store('audios');

        // Save the path to the database and return the created Audio object
        return Audio::create(['path' => $path]);
    }

    public function getAudio($audioId)
    {
        $audio = Audio::findOrFail($audioId);
        $filePath = storage_path('app/' . $audio->path);
        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            abort(404, 'Audio file not found');
        }
    }
}
