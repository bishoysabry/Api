<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\User;
use App\Transformers\UserTransformer;
class RegisterControllor extends Controller
{
    //
    public function register(Request $request)
    { //return "done";
      //return response()->json(['message' => $request->user
      //  ,'message2' => $request->email]);
      $user= new User;
      $user->username=$request->username;
      $user->email=$request->email;
      $user->password=bcrypt($request->password);
      $user->save();
    //  return response()->json(['message' => 'registration success']);
    return fractal()
    ->item($user)
    ->transformWith(new UserTransformer)
    ->toArray();
}
public function hi()
{
return "hi";
}

}
