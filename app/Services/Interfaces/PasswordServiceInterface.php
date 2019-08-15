<?php
namespace App\Services\Interfaces;

interface PasswordServiceInterface {
    
    public function create( $email);
    public function find($token);
    public function reset( $email,$password,$token);

}