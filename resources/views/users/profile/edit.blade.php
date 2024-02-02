@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{route('profile.update')}}" method="post" class="bg-white shadow rounded-3 p-5" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <h2 class="fw-light text-muted">
                    Update Profile
                </h2>

                <div class="row mb-3">
                    <div class="col-4">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt=""
                                class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
                        @endif
                    </div>
                    <div class="col-auto align-self-end">
                        <input type="file" name="avatar" id="" class="form-control">
                        <div class="form-text">
                            Acceptable formats: jpeg, jpg, png, gif only <br>
                            Maximum file size: 148mb
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="text" name="email" value="{{$user->email}}" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="introduction" class="form-label fw-bold">Introduction</label>
                    <textarea name="introduction" id="introduction"  rows="5" class="form-control">{{$user->introduction}}</textarea>
                </div>

                <button type="submit" class="btn btn-warning px-5">Save</button>




            </form>
        </div>
    </div>
@endsection