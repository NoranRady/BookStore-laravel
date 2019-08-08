<?php
namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface PasswordRepositoryInterface {

    public function create(Request $request);
    public function find($token);
    public function reset(Request $request);


}