<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTopicRequest;
use App\Topic;
use App\Post;
use App\Transformers\TopicTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Policies\TopicPolicy;
class TopicController extends Controller
{

  public function index()
  {
  //  $topics =Topic::latestFirst()->get(); without pagination
    $topics =Topic::latestFirst()->paginate(3);

  //   dd($topics); LengthAwarePaginator
  $topicsCollection = $topics->getCollection();
  // dd($topicsCollection); will get the collection

    return fractal()
    ->collection($topicsCollection) //  no differnce between $topics & $topicsCollection
    ->transformWith(new TopicTransformer)
    ->parseIncludes(['user'])
    ->paginateWith(new IlluminatePaginatorAdapter($topics)) // here cant be $topicsCollection
    ->toArray()
     ;
  }

    public function show( Topic $topic)
    {
      return fractal()
      ->item($topic,new TopicTransformer) // instead of transform with
      ->parseIncludes(['user','posts.user','posts.likes']) // posts.user make posts includeuser shown
      ->toArray();

    }
    public function update(   StoreTopicRequest $request ,Topic $topic)
    {
      $this->authorize ('update',$topic);
      $topic->title=$request->get('title',$topic->title);
      $topic->save();

      return fractal()
      ->item($topic,new TopicTransformer) // instead of transform with
      ->parseIncludes(['user','posts.user']) // posts.user make posts includeuser shown
      ->toArray();
    }



    public function destroy(Topic $topic)
    {
      $this->authorize('destroy',$topic);
      $topic->delete();
      return response(null,204);
    }


    public function store(StoreTopicRequest $request)
    {
  //    return $request->user(); return user as object
      $topic = new Topic;
      $topic->title = $request->title;
      $topic->user()->associate($request->user());

      $post = new Post;
      $post->body = $request->body;
      $post->title = $request->title;
      $post->user()->associate($request->user());

      $topic->save();
      $topic->posts()->save($post);

      return fractal()
      ->item($topic,new TopicTransformer) // instead of transform with
      ->parseIncludes(['user','posts.user']) // posts.user make posts includeuser shown
    //  ->transformWith(new TopicTransformer)
      ->toArray();


    }
}
