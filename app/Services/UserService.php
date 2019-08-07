<?php
namespace App\Services;

use App\Notifications\SignupActivate;
use App\Services\Interfaces\UserServiceInterface;
use App\User;
use App\Notifications\WelcomeMail;
use App\Repositories\Interfaces\UserRepositoryInterface ;

class UserService implements UserServiceInterface
{

    private $userRepo;
    function __construct(UserRepositoryInterface $userRepo){

        $this->userRepo=$userRepo;
    }
    public function signup($request)
    {
      return  $this->userRepo->signup($request); 
        
    }
    public function signupActivate($token)
    {
        return  $this->userRepo->signupActivate($token); 
       
    }
    public function login($request){
        return  $this->userRepo->login($request); 
    }
    public function logout($request){
        return  $this->userRepo->logout($request); 
    }
    public function user($request){
        return  $this->userRepo->user($request); 
    }

}
