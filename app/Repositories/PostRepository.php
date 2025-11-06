<?php

namespace App\Repositories;
use App\Models\Post;

class PostRepository {
    
    public function paginate(int $perPage=10) { return Post::with('user')->latest()->paginate($perPage); }
    
    public function find(int $id) { return Post::with('user')->find($id); }
    
    public function create(array $data) { return Post::create($data); }
    
    public function update(Post $post, array $data) { $post->update($data); return $post; }
    
    public function delete(Post $post) { return $post->delete(); }
}
