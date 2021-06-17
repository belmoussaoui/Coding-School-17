@extends('backoffice.index')

@section('content')
<header id="header" class="fixed-top bg-transparent border-0">
    <div class="container d-flex align-items-center justify-content-between">

    <h1 class="logo"><a href="index.html">Service Edit</a></h1>

    <nav id="navbar" class="navbar">
        <ul>
            <li><a class="getstarted mx-2" onclick="event.preventDefault(); document.getElementById('form-edit').submit()">Submit</a></li>
            <li><a class="getstarted mx-2" href="{{ route('service-items.index') }}">Back</a></li>
            {{-- <li><a class="getstarted ms-2" href="/login">Log In</a></li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
<div class="container mt-5">
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
            <div class="col-2"></div>
            <div class="col-8">
                    <form id='form-edit' action={{ route('service-items.update', $serviceItem) }} method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $serviceItem->title }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" value="{{ $serviceItem->description }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <div class="text-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="icon" value="bx-file" {{ $serviceItem->icon === 'bx-file' ? 'checked' : null }}>
                                        <label class="form-check-label py-0"><i class="fs-3 bx bx-file"></i></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="icon" value="bxl-dribbble" {{ $serviceItem->icon === 'bxl-dribbble' ? 'checked' : null }}>
                                        <label class="form-check-label py-0"><i class="fs-3 bx bxl-dribbble"></i></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="icon" value="bx-cube-alt" {{ $serviceItem->icon === 'bx-cube-alt' ? 'checked' : null }}>
                                        <label class="form-check-label py-0"><i class="fs-3 bx bx-cube-alt"></i></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="icon" value="bx-layer" {{ $serviceItem->icon === 'bx-layer' ? 'checked' : null }}>
                                        <label class="form-check-label py-0"><i class="fs-3 bx bx-layer"></i></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="icon" value="bx-images" {{ $serviceItem->icon === 'bx-images' ? 'checked' : null }}>
                                        <label class="form-check-label py-0"><i class="fs-3 bx bx-images"></i></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="icon" value="bx bx-tachometer" {{ $serviceItem->icon === 'bx bx-tachometer' ? 'checked' : null }}>
                                        <label class="form-check-label py-0"><i class="fs-3 bx bx bx-tachometer"></i></label>
                                    </div>
                                </div>
                        </div>
                    </form>
               </div>
            </div>
        </div>

    </div>
@endsection