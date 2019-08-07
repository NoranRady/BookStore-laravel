<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\BookServiceInterface ;
use App\Books;
class BookController extends Controller
{

    private $bookService;
    function __construct(BookServiceInterface $bookService){
        $this->bookService=$bookService;
    }

    public function index()
    {
      $book=  $this->bookService->index();
    }

    public function store(Request $request)
    {
      
      $request_values=$request->all();
      $this->bookService->store($request_values);     
       
    }

    public function show(Request $request)
    {
        $id=$request->get('id');
        echo($id);
        $this->bookService->show($id);
    }

    public function update(Request $request)
    {
        $request_values=$request->all();
        $this->bookService->update($request_values);
    }

    public function destroy(Request $request)
    {
         $id=$request->get('id');
        
         $this->bookService->delete($id);
        //
    }
}
