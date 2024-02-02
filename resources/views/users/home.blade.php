@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-8">
            {{-- @php
                foreach ($suggested_users as $user) {
                    echo $user['name'];
                }

            @endphp
            @php
                foreach ($follower_posts as $post) {
                    echo $post['description'];
                }
            @endphp --}}
            @forelse ($follower_posts as $post)
                <div class="card mb-4">
                    {{-- title --}}
                    @include('users.post.contents.title')

                    {{-- body --}}
                    @include('users.post.contents.body')
                </div>
            @empty
                {{-- if the site does not have a post --}}
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-muted">When you share photos, they'll appear on your profile</p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">Share your first photo</a>
                </div>
            @endforelse
        </div>
        <div class="col-4">
            <div class="card align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            @if (Auth::user()->avatar)
                                {{-- <div class="ratio ratio-1x1"> --}}
                                <img src="{{ Auth::user()->avatar }}" alt=""
                                    class="img-fluid rounded rounded-circle">
                                {{-- </div> --}}
                            @else
                                <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                            @endif
                        </div>
                        <div class="col-8">
                            <h3>{{ Auth::user()->name }}</h3>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-5">
                <div class="row ">
                    <div class="col-9">
                        <p class="fw-bold text-secondary">Suggestions for you</p>
                    </div>
                    <div class="col-3">
                        <a href="{{route('suggests')}}" class="fw-bold text-dark text-decoration-none">See all</a>

                    </div>
                </div>
                @foreach ($suggested_users as $user)
                    <div class="row align-items-center mb-3">
                        <div class="col-2">
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary fa-2x"></i>
                            @endif
                        </div>
                        <div class="col-7 ps-0 text-truncate">
                            <a href="{{ route('profile.show', $user->id) }}"
                                class="text-secondary text-dark fw-bold text-decoration-none">{{ $user->name }}</a>
                        </div>
                        <div class="col-3">
                            <form action="{{ route('follow', $user->id) }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="border-0 bg-transparent p-0 text-primary btn-sm text-start">Follow</button>

                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
