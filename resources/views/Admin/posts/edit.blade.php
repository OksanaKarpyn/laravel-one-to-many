@extends('layouts.appDashboard')
@section('content')
<h2>paggina edit</h2>
<div class="container">
<form action="{{route('admin.posts.update', $mod_post['id'] )}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-control">
        <div class="form-group mt-3">
            <label for="input-title" class="form-label text-white">Title</label>
            <input type="text" id="input-title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="titolo" autofocus value="{{ old('title') ?? $mod_post->title }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="input-content" class="form-label text-white">Content</label>
            <textarea id="input-content" class="form-control" name="content" cols="35" rows="3">{{ old('content') ?? $mod_post->content }}
            </textarea>
        </div> 
        <div class="form-group mt-3">
            <label for="input-slug" class="form-label text-white">Slug</label>
            <input type="text" id="input-slug" class="form-control" name="slug" placeholder="titolo-slug" autofocus value="{{ old('slug') ?? $mod_post->slug }}">
        </div>
    </div>
    <div class="form-group mt-3">
        <label for="input-image" class="form-label">Image</label>
        <input type="file" id="input-image" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary btn-outline-light my-4 col-2 mx-auto text-uppercase"><strong> create </strong></button>
</form>
</div>
@endsection