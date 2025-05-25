<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use GeneralTrait;


    public function register(RegisterRequest $request){
        try{
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role'),
            ]);
            $user->makeHidden(['created_at','updated_at']);
    
            $user->token = $user->createToken('MyApp')->plainTextToken;
            return $this->buildResponse($user,'Success','The registration succeeded',200);
        }catch(\Exception $ex){
            return $this->buildResponse($ex,'Error','Failed to register!',400);
        }
    }



    public function login(LoginRequest $request){
        try{
            $user = User::where('email',$request->input('email'))->first();

            if(!$user){
                return $this->buildResponse(null,'Error','User not found',404);
            }

            if(!Hash::check($request->input('password'),$user->password)){
                return $this->buildResponse(null,'Error','Your email or password is uncorrect!',400);
            }

            $user->token = $user->createToken('token')->plainTextToken;

            return $this->buildResponse($user,'Success','You have logged in successfully',200);
        }catch(\Exception $ex){
            return $this->buildResponse($ex,'Error','Failed to login!',400);
        }
    }
   
}
