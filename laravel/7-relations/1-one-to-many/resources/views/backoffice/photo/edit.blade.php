@extends('layouts.app')

@section('content')
    <h2 class="text-center text-decoration-underline my-3">Edit Album</h2>
    <ul class="bg-danger rounded">
    
    @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
    
    </ul>
    <form action="/photos/{{ $photo->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom">
        </div>
        <div class="mb-3">
            <label class="form-label">Lien</label>
            <input type="file" class="form-control" name="lien">
        </div>
        <div class="mb-3">
            <label class="form-label">Categorie</label>
            <input type="text" class="form-control" name="categorie">
        </div>
        <div class="mb-3">
            <label class="form-label">Album</label>
            <select name="album_id" class="form-control">
                @foreach ($albums as $album)
                    <option value="{{ $album->id }}">{{ $album->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection