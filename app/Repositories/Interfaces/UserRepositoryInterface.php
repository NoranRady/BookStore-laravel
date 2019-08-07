<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {

    public function signup($request);
    public function signupActivate($token);
    public function login($request);
    public function logout($request);
    public function user($request);
}