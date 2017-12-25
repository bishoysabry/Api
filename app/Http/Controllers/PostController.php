<?php

namespace App\Http\Controllers;
use App\Post;
use App\Topic;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
class PostController extends Controller
{

  public function store(StorePostRequest $request,Topic $topic)
  {
    $post = new Post;
    $post->title = $request->title;
    $post->body = $request->body;
    $post->user()->associate($request->user());
    $topic->posts()->save($post);



    return fractal()
    ->item($post,new PostTransformer) // instead of transform with
    ->parseIncludes(['user'])
    ->toArray();


  }





  public function update( StorePostRequest $request,Topic $topic ,Post $post )
  {

      $post->title = $request->get('title',$post->title);
      $post->body = $request->get('body',$post->body);
      $post->save();


  }

  // other post methods are easy to go show-delete-
}
