@extends('layout.master')
@section('title', 'Update Page')

@section('content')
    <h1>Update Page</h1>

    <form action="{{ route('update', $book->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="title_book" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $book->title }}">
        </div>
        <div class="mb-3">
            <label for="author_book" class="form-label">Author</label>
            <input type="text" class="form-control" name="author" value="{{ $book->author }}">
        </div>
        <div class="mb-3">
            <label for="publisher_book" class="form-label">Publisher</label>
            <input type="text" class="form-control" name="publisher" value="{{ $book->publisher }}">
        </div>
        <div class="mb-3">
            <label for="year_book" class="form-label">Year</label>
            <input type="year" class="form-control" name="year" value="{{ $book->year }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
