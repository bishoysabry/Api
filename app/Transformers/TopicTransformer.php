<?php
namespace App\Transformers;


use App\Topic;
class TopicTransformer extends \League\Fractal\TransformerAbstract  {


protected $availableIncludes=['user','posts'];
// to make it appear without parseincludes in TopicController make it defualtIncludes

public function transform(Topic $topic )
{
  return [
    'topic - id'=>$topic->id,
    'topic - title'=>$topic->title,
    'topic - created_at'=>$topic->created_at->toDateTimeString(),
    'topic - created_at - humans '=>$topic->created_at->diffForHumans(),
  ];
}
public function includeUser(Topic $topic)
{
  return $this->item($topic->user,new UserTransformer);
}
public function includePosts(Topic $topic)
{
  return $this->collection($topic->posts,new PostTransformer);
}

}
