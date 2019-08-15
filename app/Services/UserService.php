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
    public function signup($name,$position,$email,$password)
    {
      return  $this->userRepo->signup($name,$position,$email,$password); 
        
    }
    public function signupActivate($token)
    {
        return  $this->userRepo->signupActivate($token); 
       
    }
    public function login($email, $password,$user,$request){
        return  $this->userRepo->login($email, $password,$user,$request); 
    }
    public function logout($user){
        return  $this->userRepo->logout($user); 
    }
    public function user($user){
        return  $this->userRepo->user($user); 
    }

}
