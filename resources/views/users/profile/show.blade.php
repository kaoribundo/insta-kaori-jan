@extends('layouts.app')

@section('title')


@section('content')
    @include('users.profile.header')

    <div style="margin-top:100px">

        <div class="row justify-content-center " id="posts">
            <div class="col-5">
                @if ($user->posts->isNotEmpty())
                    <div class="row">

                        @foreach ($user->posts as $post)
                            <div class="col-lg-4">
                                <a href="{{ route('post.show', $post->id) }}">
                                    <img src="{{ $post->image }}" alt="" class="img-thumbnail">
                                </a>
                            </div>
                        @endforeach

                    </div>
                @else
                    <h3 class="text-center">No Posts.</h3>
                @endif
            </div>
        </div>

    </div>
@endsection
