<?php
namespace App\Repositories;


use App\Repositories\Interfaces\BookRepositoryInterface ;
use App\Books;
use Illuminate\Http\Request;

class BookRepository implements BookRepositoryInterface

{

    private $Book;
    function __construct(Books $Book) {

        $this->Book= $Book;
       // $this->middleware('auth');
    }
    public function store($request_values)
    {
        $book = Books::create($request_values);
        $book->save();
    }
    public function update($request_values){
        $book=Books::find($request_values['id']);
        $book->bookname=$request_values['bookname'];
        $book->isbn=$request_values['isbn'];
        $book->author = $request_values['author'];
       // $book->production_date = $request_values['production_date'];
        $book->language = $request_values['language'];
        $book->description = $request_values['description'];
        $book->save();

    }
    public function delete($id){
       // $book=Books::find($id);
      // $request->user()->authorizeRoles(['employee']);
        Books::destroy($id);
        return "Deleted!";

    }
    public function show($id){
        $book=Books::find($id);
        echo( $book);
    }
    public function index(){
        $book = Books::all();
        echo($book);
    }
}