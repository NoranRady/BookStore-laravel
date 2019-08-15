<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {

    public function signup($name,$position,$email,$passwords);
    public function signupActivate($token);
    public function login($email, $password,$user,$request);
    public function logout($user);
    public function user($user);
}