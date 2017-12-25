<?php
namespace App\Transformers;


use App\Post;
class PostTransformer extends \League\Fractal\TransformerAbstract  {


protected $availableIncludes=['user','likes'];
//  protected $defaultIncludes=['user'];
//to make it appear without parseincludes in postController make it defualtIncludes

public function transform(Post $post )
{
  return [
    'post - id'=>$post->id,
    'post - title'=>$post->title,
    'post - body'=>$post->body,
    'post - likesCount'=>$post->likes->count(),
    'post - created_at'=>$post->created_at->toDateTimeString(),
    'post - created_at - humans '=>$post->created_at->diffForHumans(),
  ];
}
public function includeUser(Post $post)
{
  return $this->item($post->user,new UserTransformer);
}
public function includeLikes(Post $post)
{

return $this->collection($post->likes->pluck('user'),new UserTransformer);
// pluck bring from array key=> 'user' |  wont work if cascade not work as inndodb wasnt existed
}

}
