<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;
interface BookServiceInterface {
    public function update($id,$bookname,$isbn,$author,$publication_date,$language,$description);
    public function delete($id);
    public function show($id);
    public function index();
    public function store($bookname,$isbn,$author,$publication_date,$language,$description);
}