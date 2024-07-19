@extends('layout.app')

@section('content')
    <h1>Create New Namevg</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('namevgs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="producer">Producer:</label>
            <input type="text" name="producer" class="form-control" placeholder="Producer">
        </div>
        <div class="form-group">
            <label for="owner">Owner:</label>
            <input type="text" name="owner" class="form-control" placeholder="Owner">
        </div>
        <div class="form-group">
            <label for="releasedata">Release Date:</label>
            <input type="date" name="releasedata" class="form-control">
        </div>
        <div class="form-group">
            <label for="digital">Digital:</label>
            <select name="digital" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="weight">Weight:</label>
            <input type="text" name="weight" class="form-control" placeholder="Weight">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
