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
    public function index(){
        $this->bookRepo->index();
    }
    
    public function store($request_values){    
        $this->bookRepo->store($request_values); 
    }

    public function update($request_values){
        $this->bookRepo->update($request_values);
    }

    public function delete($id){
        $book=$this->bookRepo->delete($id);
    }
    
    public function show($id){
        $this->bookRepo->show($id);
    }
    

}