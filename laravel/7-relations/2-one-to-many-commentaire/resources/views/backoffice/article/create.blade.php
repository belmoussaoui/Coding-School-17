@extends('layouts.app')

@section('content')
    <h2 class="text-center text-decoration-underline my-3">Create Article</h2>
    <ul class="bg-danger rounded">
    
    @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
    
    </ul>
    <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom">
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <label class="form-label">Categorie</label>
            <input type="text" class="form-control" name="categorie">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Auteur</label>
            <input type="text" class="form-control" name="auteur">
        </div>
        <div class="mb-3">
            <label class="form-label">Date de Publication</label>
            <input type="date" class="form-control" name="ddp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection