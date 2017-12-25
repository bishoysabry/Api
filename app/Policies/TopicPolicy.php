<?php

namespace App\Policies;
use App\User;
use App\Post;


use App\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class  TopicPolicy {

use HandlesAuthorization;

public function update(User $user ,Topic $topic)
{
   return $user->ownsTopic($topic);
}
public function destroy(User $user ,Topic $topic)
{
return $user->ownsTopic($topic);
}
public function like(User $user,Post $post)
{

 return !$user->ownsPost($post); // means that return true if user dont own the post
}



}
