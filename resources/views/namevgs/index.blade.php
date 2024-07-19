@extends('layout.app')

@section('content')
    <h1>Namevg List</h1>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <a href="{{ route('namevgs.create') }}" class="btn btn-success">Create New Namevg</a>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Producer</th>
            <th>Owner</th>
            <th>Release Date</th>
            <th>Digital</th>
            <th>Weight</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($namevgs as $namevg)
        <tr>
            <td>{{ $namevg->id }}</td>
            <td>{{ $namevg->name }}</td>
            <td>{{ $namevg->producer }}</td>
            <td>{{ $namevg->owner }}</td>
            <td>{{ $namevg->releasedata }}</td>
            <td>{{ $namevg->digital }}</td>
            <td>{{ $namevg->weight }}</td>
            <td>
                <form action="{{ route('namevgs.destroy', $namevg->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('namevgs.edit', $namevg->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
