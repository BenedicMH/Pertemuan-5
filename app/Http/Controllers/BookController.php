<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function create(Request $req)
    {
        $validated = $req->validate([
            'title' => 'required|max:8',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required',
        ], [
            'title.required' => 'the title must be filled with a valid one',
        ]);

        if ($validated) {
            Book::create([
                'title' => $req->title,
                'author' => $req->author,
                'publisher' => $req->publisher,
                'year' => $req->year,
            ]);
        }

        return back();
    }

    public function show()
    {
        // $books = DB::table('books')->join('categories', 'books.category_id', '=', 'categories.id')->get();
        $books = Book::all();
        return view('list', compact('books'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('update', compact('book'));
    }

    public function update($id, Request $req)
    {
        Book::findOrFail($id)->update([
            'title' => $req->title,
            'author' => $req->author,
            'publisher' => $req->publisher,
            'year' => $req->year
        ]);

        $books = Book::all();
        return view('list', compact('books'));

        // return redirect()->route('show');
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return back();
    }
}
