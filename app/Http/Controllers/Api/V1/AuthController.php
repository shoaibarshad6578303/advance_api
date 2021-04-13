<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\UserResource;

class AuthController extends BaseController
{
    public function temp()
    {
        dd("hello");
    }

    public function register(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError(['errors' => 'Validation Error.', $validator->errors(),
            'msg'=>'enter valid value']);       
        }
        
        // try {
            
            // dd("hello");
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success = new UserResource($user);
            
            return $this->sendResponse($success, 'User register successfully.');


        // } catch (QueryException $exception) {
        //     return response()->json([
        //         'code'      => config('constants.SERVER_ERROR') ,
        //         'message'   => $exception->getMessage(),
        //     ]);
        // }
      
    }
}
