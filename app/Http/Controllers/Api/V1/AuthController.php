<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\UserResource;
// use Illuminate\Database\QueryException;
// use Illuminate\Database\ModelException;
use Exception;
// use Illuminate\Database\Eloquent\ModelNotFoundException;


class AuthController extends BaseController
{
    public function temp()
    {
        dd("hello");
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(),400);       
            }     
        }
        
        try {
            
           
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success = new UserResource($user);
            
            return $this->sendResponse($success, 'User register successfully.',201);


        } catch (\Exception $exception) {

            return $this->sendError('Error ', $exception, 500);       
           
        }
      
    }

    public function login(Request $request){

         $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(),400);       
            }     
        }

         try {

            if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])){

                $user  = Auth::user();
                $token =  $user->createToken('authToken')->accessToken;
                $success['user'] = new UserResource($user);
                $success['token'] = $token;
                return $this->sendResponse($success, 'User login successfully.', 200);
                // return response()->json([
                //     'message'      => 'SUCCESS',
                //     'data'      => new UserResource($user),
                //     'token'     => $token
                // ]);

            }
            else{

                 return $this->sendError('UNAUTHORIZED','', 401);       
    
            }

        } catch (\Exception $exception) {
            
            return $this->sendError('SERVER_ERROR ', $exception, 500);       

        }

    }

    public function logout() {
      
    
        try {
            
            $user = Auth::user();

            foreach ($user->tokens as $token) {
                $token->revoke();
                $token->delete();
            }

            return $this->sendResponse(" ", 'User logout successfully.', 200);

        } catch (\Exception $exception) {
            return $this->sendError('SERVER_ERROR ', $exception, 500);       
        }
    }

    public function exceptionTest(){

        try{

              User::where('email','abc1238812211s@gmail.com')->firstOrFail();

        }catch(\Exception $ex){
            // $error=$ex;
            // return $error;       

            return $this->sendError(['error'=>$ex]);       
   
        }

    }


}
