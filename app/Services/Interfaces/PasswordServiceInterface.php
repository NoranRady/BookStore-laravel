<?php
namespace App\Services\Interfaces;

interface PasswordServiceInterface {
    
    public function create( $request);
    public function find($token);
    public function reset( $request);

}