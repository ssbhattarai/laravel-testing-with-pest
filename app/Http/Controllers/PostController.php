<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string'
        ];
    }

    protected function ResponseMap($post)
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'content' => $post->content
        ];
    }

    public function create(Request $request)
    {
        $request->validate($this->rules());
        $post = Post::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'post created successfully',
            'data' => $post
        ], 201);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return response()->json([
            'status' => 'success',
            'message' => 'post fetched successfully',
            'data' => $this->ResponseMap($post)
        ]);
    }

    public function update(Post $post, Request $request)
    {
        $request->validate($this->rules());

        $post->update($request->all());
        $post->refresh();

        return response()->json([
            'status' => 'success',
            'message' => 'post updated successfully',
            'data' => $this->ResponseMap($post)
        ]);
    }

    public function delete(Post $post)
    {
        $post->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'post deleted successfully',
            'data' => $this->ResponseMap($post)
        ]);
    }
}
