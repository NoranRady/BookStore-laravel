<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Services\Interfaces\PasswordServiceInterface ;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{

    private $passwordService;
    public function __construct(PasswordServiceInterface $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $email=$request['email'];
        return $this->passwordService->create($email);
     
    }
    
    public function find($token)
    {
        return $this->passwordService->find($token);
       
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string',
        ]);
        $email=$request['email'];
        $password=$request['password'];
        $token=$request['token'];
        return $this->passwordService->reset($email,$password,$token);
       
    }
}
