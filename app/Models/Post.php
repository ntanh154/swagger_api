<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table="posts";
    protected $fillable = [
        'id',
        'name',
        'title',
        'description',
    ];

    public function createPost(array $attributes){
        $post = new self();
        $post->name = $attributes["name"];
        $post->title = $attributes["title"];
        $post->description = $attributes["description"];
        $post->save();
        return $post;
    }


    public function getPost(int $id){
        $todo = $this->where("id",$id)->first();
        return $todo;
    }


    public function updatePost(int $id, array $attributes){
        $post = $this->getPost($id);
        if($post == null){
            return 'Post not found';
        }
        $post->name = $attributes["name"];
        $post->title = $attributes["title"];
        $post->description = $attributes["description"];
        $post->save();
        return $post;
    }

    public function deletePost(int $id){
        $post = $this->getPost($id);
        if($post == null){
            return 'Post not found';
        }
        return $post->delete();
    }


    public function getsPost(){
        $posts = $this::all();
        return $posts;
    }
}
