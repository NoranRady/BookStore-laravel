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

    public function show($bookId)
    {
        $this->bookService->show($bookId);
    }

    public function update(Request $request, $bookId)
    {
        $request_values = $request->all();
        $id = $bookId;
        $bookname = $request_values['bookname'];
        $isbn = $request_values['isbn'];
        $author = $request_values['author'];
        $publication_date = $request_values['publication_date'];
        $language = $request_values['language'];
        $description = $request_values['description'];
        $this->bookService->update($id, $bookname, $isbn, $author, $publication_date, $language, $description);
    }

    public function destroy($bookId)
    {
        $id = $bookId;
        return $this->bookService->delete($id);
    }
}
