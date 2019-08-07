<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;
interface BookServiceInterface {
    public function update($request_values);
    public function delete($id);
    public function show($id);
    public function index();
    public function store($request_values);
}