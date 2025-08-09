@extends('layout.master')
@section('title', 'Welcome Page')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title_book" class="form-label">Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="mb-3">
            <label for="author_book" class="form-label">Author</label>
            <input type="text" class="form-control" name="author">
        </div>
        <div class="mb-3">
            <label for="publisher_book" class="form-label">Publisher</label>
            <input type="text" class="form-control" name="publisher">
        </div>
        <div class="mb-3">
            <label for="year_book" class="form-label">Year</label>
            <input type="year" class="form-control" name="year">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Category</label>
            <select class="form-select" id="inputGroupSelect01" name="category_id">
                <option selected>Choose...</option>
                @foreach ($categories as $category)
                    <option value={{ $category->id }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02" name="gambar">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
