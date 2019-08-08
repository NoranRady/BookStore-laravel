<?php
namespace App\Http\Controllers;

use App\Notifications\SignupActivate;
use App\Services\Interfaces\UserServiceInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//use App\Mail\SendMailable;
use App\Services\MailService;
class AuthController extends Controller
{

    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
      
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        return $this->userService->signup($request);
    }
    public function signupActivate($token)
    {
        return $this->userService->signupActivate($token);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);
        return $this->userService->login($request);

    }

    public function logout(Request $request)
    {
        return $this->userService->logout($request);

    }

    public function user(Request $request)
    {
        return $this->userService->user($request);
    }

    // public function mail()
    // {
    //     $name = 'Noran';
    //     Mail::to('noran.rady@softxpert.com')->send(new MailService($name));

    //     return 'Email was sent';
    // }
}
