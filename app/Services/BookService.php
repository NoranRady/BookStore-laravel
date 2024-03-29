<?php
namespace App\Services;


use Illuminate\Http\Request;
use App\Services\Interfaces\BookServiceInterface ;
use App\Repositories\Interfaces\BookRepositoryInterface ;

class BookService implements BookServiceInterface

{
    private $bookRepo;
    function __construct(BookRepositoryInterface $bookRepo){

        $this->bookRepo=$bookRepo;
    }
    public function getAll(){
        $this->bookRepo->getAll();
    }
    
    public function create($bookname,$isbn,$author,$publication_date,$language,$description){    
        $this->bookRepo->create($bookname,$isbn,$author,$publication_date,$language,$description); 
    }

    public function update($id,$bookname,$isbn,$author,$publication_date,$language,$description){
        $this->bookRepo->update($id,$bookname,$isbn,$author,$publication_date,$language,$description);
    }

    public function delete($id){
        return   $book=$this->bookRepo->delete($id);
        
    }
    
    public function findById($id){
        $this->bookRepo->findById($id);
    }
    

}