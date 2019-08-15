<?php
namespace App\Repositories;

use App\Books;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{

    private $Book;
    public function __construct(Books $Book)
    {
        $this->Book = $Book;
    }
    public function store($bookname, $isbn, $author, $publication_date, $language, $description)
    {
        $book = Books::create([
            'bookname' => $bookname,
            'isbn' => $isbn,
            'author' => $author,
            'publication_date' => $publication_date,
            'language' => $language,
            'description' => $description]);

        $book->save();
    }
    public function update($id, $bookname, $isbn, $author, $publication_date, $language, $description)
    {
        $book = Books::find($id);
        $book->bookname = $bookname;
        $book->isbn = $isbn;
        $book->author = $author;
        $book->publication_date = $publication_date;
        $book->language = $language;
        $book->description = $description;
        $book->save();
    }
    public function delete($id)
    {
        Books::destroy($id);
        return "Deleted!";
    }
    public function show($id)
    {
        $book = Books::find($id);
        echo ($book);
    }
    public function index()
    {
        $book = Books::all();
        echo ($book);
    }
}
