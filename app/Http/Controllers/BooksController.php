<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
	public function index(Request $request)
	{
	    $books = \App\Models\Book::get();
	    if($request->ajax()){
	        return array_reverse($books->toArray());
	    }
	    //return view('index', compact('books'));
	}

    public function store(Request $request)
    {
        $book = new Book([
            'author' => $request->input('author'),
            'co_author' => $request->input('co_author'),
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        $book->save();

        return response()->json('Книга добавлена!');        
    }

    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->update($request->all());

        return response()->json('Книга обновлена!');        
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return response()->json('Книга удалена!');        
    } 

    public function show($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    public function search($key, Request $request)
    {
        $books = \App\Models\Book::search($key)->get();
        if($request->ajax()){
            return array_reverse($books->toArray());
        }
    }

    public function sort($key, Request $request)
    {
        $books = null;
        switch ($key) {
            case 'author':
                $books = \App\Models\Book::sortByAuthor()->get();
                break;
            case 'title':
                $books = \App\Models\Book::sortByTitle()->get();
                break; 
            case 'description':
                $books = \App\Models\Book::sortByDescription()->get();
                break; 
            case 'created_at':
                $books = \App\Models\Book::sortByDate()->get();
                break;                                              
        }
        if($request->ajax()){
            return array_reverse($books->toArray());
        }
    }                   	 
}
