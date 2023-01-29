<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Support\Str;
use App\Rules\Uppercase;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;

class AuthController extends BaseController
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile_number' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password|min:6',
        ]);
        if ($validator->fails())
        {
            return $this->sendError('Validatoin Error',$validator->errors());
        }
        $email = $request->email;
        $request['password']=Hash::make($request['password']);
        $user = User::create($request->toArray());
        $id = User::where('email', $email)->value('id');
        $id_Stu = EventUser::where('email', $email)->value('id');
        $eventUser = EventUser::create([
            'name' => strtoupper($request->name),
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $request->password,
            'user_id' => $id,
            ]);
            $id_Stu = EventUser::where('email', $email)->value('id');
        $success['token'] = $user->createToken('apiToken')->plainTextToken;
        $success['name'] = $eventUser->name;
        $success['id'] = $eventUser->id;
        return $this->sendResponse($success,'User Registrated Successfully');
    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails())
        {
            return $this->sendError('Validatoin Error',$validator->errors());
        }
        $user = EventUser::where('email', $request->email)->first();
        if ($user) {
            //dd(Hash::check($request->password, $user->user_password));
            if( Hash::check($request->password, $user->password)){
                $success['token'] = $user->createToken('apiToken')->plainTextToken;
                $success['name'] = $user->name;

                return $this->sendResponse($success,'User Logged in Successfully');

            } else {
                return $this->sendError('Unauthorized', ['error' => 'Unauthorized']);
            }
                }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse([],'User Logged out');
    }
}
