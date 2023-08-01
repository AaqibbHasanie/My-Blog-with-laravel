<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\tags;

class PostController extends Controller
{
    public function deletePost(Post $post)
    {
        if (auth()->user()->id === $post->user_id) {
            $post->tags()->detach();
            $post->delete();
        }
        return redirect('/');
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $title = $request->input('title');
        $body = $request->input('body');
        $category_id = $request->input('category_id');
        $user_id = auth()->user()->id;

        $post = new Post();
        $post->title = $title;
        $post->body = $body;
        $post->user_id = $user_id;
        $post->category_id = $category_id;
        $post->save();

        $tag_ids = $request->input('tags');

        if (!empty($tag_ids)) {
            $post->tags()->attach($tag_ids);
        }

        return redirect('/');
    }

    public function showEditScreen(Post $post)
    {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $category = $post->category;
        $tags = $post->tags;

        return view('edit-post', compact('post', 'category', 'tags'));
    }

    public function actuallyUpdatePost(Post $post, Request $request)
    {
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'array|exists:tags,id',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        if (isset($incomingFields['category_id'])) {
            $post->category_id = $incomingFields['category_id'];
        } else {
            $post->category_id = null;
        }

        $post->tags()->detach();

        if (isset($incomingFields['tags']) && is_array($incomingFields['tags'])) {
            $post->tags()->attach($incomingFields['tags']);
        }

        $post->update([
            'title' => $incomingFields['title'],
            'body' => $incomingFields['body'],
        ]);

        return redirect('/');
    }
}
