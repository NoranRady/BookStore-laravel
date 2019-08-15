<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;
interface BookServiceInterface {
    public function update($id,$bookname,$isbn,$author,$publication_date,$language,$description);
    public function delete($id);
    public function findById($id);
    public function getAll();
    public function create($bookname,$isbn,$author,$publication_date,$language,$description);
}