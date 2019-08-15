<?php
namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface PasswordRepositoryInterface {

    public function create($email);
    public function find($token);
    public function reset($email,$password,$token);


}