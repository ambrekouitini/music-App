<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class ApiKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $apiKeys = $user->apiKeys()->get();

        return Inertia::render('ApiKey/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ApiKey/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
        ]);

        $apiKey = $request->user()->apiKeys()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('apiKeys.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ApiKey $apiKey)
    {
        return Inertia::render('ApiKey/Show', [
            'apiKey' => $apiKey,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApiKey $apiKey)
    {
        return Inertia::render('ApiKey/Edit', [
            'apiKey' => $apiKey,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApiKey $apiKey)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
        ]);

        $apiKey->update([
            'name' => $request->name,
        ]);

        return redirect()->route('apiKeys.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();

        return redirect()->route('apiKeys.index');
    }
}
