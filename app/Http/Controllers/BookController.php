<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{

    private $bookService;
    public function __construct(BookServiceInterface $bookService)
    {
        $this->bookService = $bookService;
        // $this->middleware('checkAuth');
    }

    public function index()
    {
        $book = $this->bookService->index();
    }

    public function store(Request $request)
    {

        $request_values = $request->all();
        $bookname = $request_values['bookname'];
        $isbn = $request_values['isbn'];
        $author = $request_values['author'];
        $publication_date = $request_values['publication_date'];
        $language = $request_values['language'];
        $description = $request_values['description'];
        $this->bookService->store($bookname, $isbn, $author, $publication_date, $language, $description);

    }

    public function show(Request $request)
    {
        $id = $request->get('id');
        echo ($id);
        $this->bookService->show($id);
    }

    public function update(Request $request)
    {
        $request_values = $request->all();
        $id = $request_values['id'];
        $bookname = $request_values['bookname'];
        $isbn = $request_values['isbn'];
        $author = $request_values['author'];
        $publication_date = $request_values['publication_date'];
        $language = $request_values['language'];
        $description = $request_values['description'];
        $this->bookService->update($id, $bookname, $isbn, $author, $publication_date, $language, $description);
    }

    public function destroy(Request $request)
    { // $request->user()->authorizeRoles(['employee']);
        $id = $request->get('id');
        return $this->bookService->delete($id);
        //
    }
}
