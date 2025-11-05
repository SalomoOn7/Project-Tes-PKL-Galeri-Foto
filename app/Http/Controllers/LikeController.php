<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Like::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back();
    }

    public function show(Like $like)
    {
        //
    }

    public function edit(Like $like)
    {
        //
    }

    public function update(Request $request, Like $like)
    {
        //
    }

    public function destroy(Like $like)
    {
        //
    }
}
