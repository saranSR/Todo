<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ToDoController extends Controller
{
    //
    public function createuser(Request $request)
    {
            $inputs=$request->data;
           $user= User::create([
                'name' =>$inputs['name'],
                'email'=>$inputs['email'],
                'password'=>$inputs['password']
            ]);
            return $user->createToken('vue-spa')->plainTextToken;
    }

    public function login(Request $inputs)
    {
            $inputs->validate([
                'email'=>'required|email',
                'password'=>'required'
            ]);
            if(Auth::attempt(['email' => $inputs->email, 'password' => $inputs->password]))
            {
                return Auth::user()->createToken('vue-spa')->plainTextToken;
            }
            return response()->json(['message'=>'Invalid Credentials'],402);
    }

    public function logout(Request $inputs)
    {
        $inputs->user()->currentAccessToken()->delete();
    }
       public function list(Request $inputs)
        {
           return response()->json(ToDo::with('created_by')->get(),201);
        }

        function createtodo(Request $inputs)
        {
         $inputs->validate([
            'todo'=>'required'
         ]);
            ToDo::create([
                'user_id'=>$inputs->user()->id,
                'content'=>$inputs->todo
            ]);
            return ['message'=>'Todo Added'];
        }
        public function updatetodo(Request $inputs,$id)
        {
                return Todo::find($id)->update(['status'=>true]);
        }
        function delete(ToDo $id)
        {
            $id->delete();
        }
}
