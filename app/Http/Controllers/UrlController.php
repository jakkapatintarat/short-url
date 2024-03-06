<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        return view('urls.index', [
            'urls' => Url::where('user_id', $user)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|string|url|max:255'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['original_url'] = $request->original_url;
        $data['shorten_url'] = Str::random(6);

        Url::create($data);
        return redirect(route('urls.index'));
    }

    public function listData()
    {
        $data = Url::get();
        // dd($data);
        return view('dashboard', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return redirect(route('urls.index'));
    }

    public function shortUrl($short_url)
    {
            $find = Url::where('shorten_url', $short_url)->first();
            // dd($find);
            if(!$find){
                return route('urls.index');
            }
            $find->increment('engagements');
            return redirect($find->original_url);
    }
}
