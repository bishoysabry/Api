<?php

namespace App\Policies;
use App\User;


use App\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class  TopicPolicy {

use HandlesAuthorization;

public function update(User $user ,Topic $topic)
{
  //return $user->ownsTopic($topic); dont know owns belongs to which technique 
  return $user->id == $topic->user_id;
}
public function destroy(User $user ,Topic $topic)
{
return $user->id == $topic->user_id;
}

}
