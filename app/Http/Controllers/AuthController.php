<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Services\MailService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
//use App\Mail\SendMailable;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SignupActivate;
use App\Services\Interfaces\UserServiceInterface;

class AuthController extends Controller
{

    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
      
    }

    public function signup(SignupRequest $request)
    {
        $request_values = $request->all();
        $name=$request_values['name'];
        $position=$request_values['position'];
        $email=$request_values['email'];
        $password=$request_values['password'];
        return $this->userService->signup($name,$position,$email,$password);
    }
    public function signupActivate($token)
    {
        return $this->userService->signupActivate($token);

    }

    public function login(LoginRequest $request)
    {
        $email=$request['email'];
        $password=$request['password'];
        $user=$request->user();
        //dd($user);
        return $this->userService->login($email, $password,$user,$request);

    }

    public function logout(Request $request)
    {
        $user=$request->user();
        return $this->userService->logout($user);

    }

    public function user(Request $request)
    { 
        $user=$request->user();
        return $this->userService->user($user);
    }

   
}
