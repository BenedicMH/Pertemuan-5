<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookApiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $books = Book::with('category')
            ->when($request->get('category_id'), function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($request->get('search'), function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Books retrieved successfully',
            'data' => $books
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'category_id' => 'required|exists:categories,id',
            'book_gambar' => 'nullable|string|max:255'
        ]);

        $book = Book::create($validated);
        $book->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    public function show(Book $book)
    {
        $book->load('category', 'phone');
        
        return response()->json([
            'success' => true,
            'message' => 'Book retrieved successfully',
            'data' => $book
        ], 200);
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'publisher' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer|min:1000|max:' . (date('Y') + 1),
            'category_id' => 'sometimes|required|exists:categories,id',
            'book_gambar' => 'nullable|string|max:255'
        ]);

        $book->update($validated);
        $book->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully',
            'data' => $book
        ], 200);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully'
        ], 200);
    }

    public function search($query)
    {
        $books = Book::with('category')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->orWhere('publisher', 'like', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->limit(20)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Search results retrieved successfully',
            'data' => $books
        ], 200);
    }
}