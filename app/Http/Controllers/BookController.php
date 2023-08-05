<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    private $book;

    public function __construct(
        Book $book
    ) {
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("books.index", ["books" => $this->book->getBooks()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("books.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->book->create(["name" => $request->name]);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->book->find($id);

        return view("books.show", ["book" => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = $this->book->find($id);

        return view("books.edit", ["book" => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = $this->book->find($id);
        $data = ["name" => $request->name];
        $book->update($data);

        return redirect()->route('books.show', $book->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = $this->book->find($id);
        $book->delete();

        return redirect()->route('books.index');
    }
}
