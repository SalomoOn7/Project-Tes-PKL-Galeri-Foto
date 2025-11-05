<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class PostController extends Controller
{
    public function my()
    {
        $posts = Post::with(['user', 'like'])->where('user_id', auth()->user()->id)->latest()->get();
        return view('posts.my', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'filename' => 'required'
        ]);
        $path = $request->file('filename')->store('posts', 'public');

            Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'filename' => $path
            ]);
            return redirect('/posts/my')->with('success', 'Foto berhasil diupload!');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) Abort(403); {
            return view('posts.edit', compact('post'));
        }
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) Abort(403); {
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'filename' => 'nullable|image|max:5120'
        ]);

        if ($request->hasFile('filename')) {
            if ($post->filename && \Storage::disk('public')->exists($post->filename)) {
                \Storage::disk('public')->delete($post->filename);
            }

            $path = $request->file('filename')->store('posts', 'public');
            $post->filename = $path;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return redirect('posts/my')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) Abort(403); {
        Storage::disk('public')->delete($post->filename);
        $post->delete();
        return back()->with('success', 'Foto berhasil dihapus!');
        }
    }
}
