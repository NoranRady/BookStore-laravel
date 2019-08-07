<?php
namespace App\Services\Interfaces;

interface UserServiceInterface{

    public function signup($request);
    public function signupActivate($token);
    public function login($request);
    public function logout($request);
    public function user($request);

}