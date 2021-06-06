@extends('layouts.index')

@section('content')
    @include('backoffice.header ')

        <section id="about" class="about">
            <div class="container">
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row mt-2 pt-5">
                    <div class="row col-lg-5 order-1 order-lg-2 align-items-center" data-aos="zoom-in" data-aos-delay="150">
                        <img src={{asset("img/edit.svg")}} class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-7 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
                    <a href={{ route('about.index') }} class="btn read-more px-2 py-1">Back</a>
                    <div class="section-title">
                        <h2 style="back">About Edit </h2>
                    </div>
                        
                        <form action={{ route('about.update', $about) }} method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{$about->title}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" name="description" value="{{$about->description}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fact 1</label>
                                <input type="text" class="form-control" name="fact1" value="{{$about->fact1}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fact 2</label>
                                <input type="text" class="form-control" name="fact2" value="{{$about->fact2}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fact 3</label>
                                <input type="text" class="form-control" name="fact3" value="{{$about->fact3}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Button</label>
                                <input type="text" class="form-control" name="button" value="{{$about->button}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <button type="submit" class="btn read-more">Submit</button>
                        </form>
                    </div>
                </div>
      
            </div>
          </section><!-- End About Section -->
@endsection