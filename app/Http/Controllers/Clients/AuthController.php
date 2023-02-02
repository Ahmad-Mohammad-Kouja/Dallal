<?php

namespace App\Http\Controllers\Clients;

use App\Classes\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\RegisterRequest;
use App\Http\Requests\Client\Auth\SignInRequest;
use App\Http\Requests\Client\Auth\SignUpRequest;
use App\Models\Clients\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   private $users=null;

    /**
     * AuthController constructor.
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function SignUp(SignUpRequest $request)
    {
        $userData=$request->validated();
        $userData['username'] = $userData['first_name'].' '.$userData['last_name'];
        $addedUser=$this->users->createData($userData);
        if(empty($userData))
            return ResponseHelper::generalError();
        return ResponseHelper::insert($this->users->login(['email' => $addedUser['email'], 'password' => $userData['password']]));
    }

    public function signIn(SignInRequest $request)
    {
        $userData=$request->validated();
        $signedUser=$this->users->login($userData);
        return (empty($signedUser)) ? ResponseHelper::isEmpty('check your credential') : ResponseHelper::select($signedUser);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return ResponseHelper::select('logout');
    }
}
