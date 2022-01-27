<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{

    public function login()
    {

        $email = request()->email;
        $password = request()->password;

        $errors = [];
//           FORM VALIDATION


        if(empty($email)) {
            $errors['email'] = 'Email field is required';
        }elseif(!User::where('email', $email)->first()) {
            $errors['email'] = 'Email address doesnt exist';

        }
        if(empty($password)) {
            $errors['password'] = 'Password field is required';
        } elseif($obj = User::where('email', $email)->first()) {
            if(!password_verify($password, $obj->password)) {
                $errors['password'] = 'Password do not match';

            }
        }




        if(count($errors) > 0) return response()->json(['errors' => $errors]);

        $user = User::where('email', $email)->first();
//       return response()->json(['data', $user]);




//        CREATE ACCESS TOKEN
        $tokens = $user->tokens;
        if(count($tokens) > 0) {
            foreach($tokens as $token) $token->delete();
            $token = $user->createToken('Access token')->accessToken;
        } else {
            $token = $user->createToken('Access token')->accessToken;

        }












//        END CREATING TOKEN;
//        return response()->json(['data' => ['user' => $user, 'token' => $token]]);





        $user->token = $token;



        return new UserResource($user);

    }
    public function logout()
    {


//        session_destroy();


        $tokens = auth()->user()->tokens;
        if(count($tokens) > 0) {
            foreach($tokens as $token) $token->delete();

            return response()->json(['code' => 200]);
        }

        return response()->json(['code' => 500]);



    }

}
