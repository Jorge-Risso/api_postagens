<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function list($perPage = 10)
    {
        return Post::with('user')->paginate($perPage);
    }

    public function find($id)
    {
        return Post::with('user')->find($id);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update($id, array $data)
    {
        $post = Post::findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }
}
