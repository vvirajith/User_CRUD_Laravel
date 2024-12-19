<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/');

    }

    public function actuallyUpdatePost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        try {
            $post->update([
                'title' => $incomingFields['title'],
                'body' => $incomingFields['body']
            ]);

            return redirect('/')->with('success', 'Post updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update post. Please try again.');
        }
    }

    public function showEditScreen(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/');
    }
}
