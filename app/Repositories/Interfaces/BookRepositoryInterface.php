<?php
namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
interface BookRepositoryInterface {


    public function update($request_values);
    public function delete();
    public function show($id);
    public function index();
    public function store($request_values);


}