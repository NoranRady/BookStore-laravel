<?php
namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Requests\MailRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Services\Interfaces\PasswordServiceInterface ;

class PasswordResetController extends Controller
{

    private $passwordService;
    public function __construct(PasswordServiceInterface $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    public function create(MailRequest $request)
    {
        $email=$request['email'];
        return $this->passwordService->create($email);
     
    }
    
    public function find($token)
    {
        return $this->passwordService->find($token);
       
    }

    public function reset(PasswordRequest $request)
    {
        $email=$request['email'];
        $password=$request['password'];
        $token=$request['token'];
        return $this->passwordService->reset($email,$password,$token);
       
    }
}
