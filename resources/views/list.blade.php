@extends('layout.master')
@section('title', 'Welcome Page')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Publisher</th>
                <th scope="col">Year</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $b)
                <tr>
                    <th scope="row">{{ $b->id }}</th>
                    <td>{{ $b->title }}</td>
                    <td>{{ $b->author }}</td>
                    <td>{{ $b->publisher }}</td>
                    <td>{{ $b->year }}</td>
                    <td>
                        @foreach ($b->suppliers as $be)
                    <td>{{ $be->name }}</td>
                    <td>{{ $be->location }}</td>
            @endforeach
            </td>
            <td>
                <a href="{{ route('edit', $b->id) }}" class="btn btn-success">Update</a>
                <form action="{{ route('delete', $b->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
