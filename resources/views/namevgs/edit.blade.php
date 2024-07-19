@extends('layout.app')

@section('content')
    <h1>Edit Namevg</h1>
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
    <form action="{{ route('namevgs.update', $namevg->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $namevg->name }}">
        </div>
        <div class="form-group">
            <label for="producer">Producer:</label>
            <input type="text" name="producer" class="form-control" value="{{ $namevg->producer }}">
        </div>
        <div class="form-group">
            <label for="owner">Owner:</label>
            <input type="text" name="owner" class="form-control" value="{{ $namevg->owner }}">
        </div>
        <div class="form-group">
            <label for="releasedata">Release Date:</label>
            <input type="date" name="releasedata" class="form-control" value="{{ $namevg->releasedata }}">
        </div>
        <div class="form-group">
            <label for="digital">Digital:</label>
            <select name="digital" class="form-control">
                <option value="1" {{ $namevg->digital ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$namevg->digital ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="weight">Weight:</label>
            <input type="text" name="weight" class="form-control" value="{{ $namevg->weight }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
