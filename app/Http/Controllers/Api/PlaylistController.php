<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->get('user_id');
        $playlists = Playlist::where('user_id', $userId)->get();

        return response()->json($playlists);
    }
}
