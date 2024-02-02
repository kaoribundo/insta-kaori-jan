@extends('layouts.app')

@section('title','Edit Post')

@section('content')
<div class="container justify-content-center">
  <div class="row mx-auto">
    <div class="col-12">
      <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      {{-- categories --}}
        <label for="categories" class="form-label d-block fw-bold">
          {{__("Categories")}} <span class="text-muted fw-normal">{{__("(up to 3)")}}</span>
        </label>
        @foreach($categories as $category)
        <div class="form-check form-check-inline">
          @if (in_array($category->id,$selected_categories))
            <input class="form-check-input" type="checkbox" name="category[]"  id="{{ $category->name }}" value="{{ $category->id }}" checked>
          @else
            <input class="form-check-input" type="checkbox" name="category[]"  id="{{ $category->name }}" value="{{ $category->id }}">
          @endif
          <label class="form-check-label" for="{{ $category->name }}" >{{ $category->name }}</label>
        </div>
        @endforeach
        @error('category')
        <div class="small text-danger">{{ $message }}</div>
        @enderror
      {{-- Description --}}
        <label for="description" class="form-label d-block fw-bold mt-3">
          Description
        </label>
        <textarea name="description" id="description" rows="6" class="form-control" placeholder="Whats on your mind?">{{$post->description}}</textarea>
        @error('desc')
        <div class="small text-danger">{{ $message }}</div>
        @enderror

      {{-- Image --}}
        <label for="image" class="form-label d-block fw-bold mt-3">
          <img src="{{$post->image}}" class="d-block img-thumbnail" alt="" height="250" width="250">
        </label>
        <input type="file" name="image" id="image" class="form-control">
        @error('image')
        <div class="small text-danger">{{ $message }}</div>
        @enderror
        <p class="text-secondary fs-6 mt-1">
          The accepted formats are .jpeg .jpg .png and gif only. <br>
          Maximum file size is 1048kB.
        </p>

      {{-- button --}}
      <button class="btn btn-warning px-5">Save</button>
      </form>
    </div>
  </div>
</div>

@endsection