<?php
namespace App\Services\Interfaces;

interface UserServiceInterface{

    public function signup($name,$position,$email,$password);
    public function signupActivate($token);
    public function login($email, $password,$user,$request);
    public function logout($user);
    public function user($user);

}