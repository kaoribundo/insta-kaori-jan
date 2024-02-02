@extends('layouts.app')

@section('title')


@section('content')
    @include('users.profile.header')

    <div style="margin-top:100px">

        <div class="row justify-content-center  mt-2" id="followers">
            <div class="col-5">

                @if ($user->follows->isNotEmpty())
                    <h2 class="mb-3 text-center">Followers</h2>
                    @foreach ($user->follows as $follower)
                        <div class="row align-items-center mb-3">
                            <div class="col-2">
                                @if ($follower->follows->avatar)
                                    <img src="{{ $follower->follows->avatar }}" alt=""
                                        class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user fa-2x text-secondary"></i>
                                @endif
                            </div>
                            <div class="col-7 ps-0 text-truncate">
                                <a href="{{ route('profile.show', $follower->follows->id) }}"
                                    class="text-secondary text-dark fw-bold text-decoration-none">{{ $follower->follows->name }}</a>
                            </div>
                            <div class="col-3">
                                @if ($follower->follows->id == Auth::user()->id)
                                    {{ __('') }}
                                @elseif ($follower->follows->isFollowed())
                                    <form action="{{ route('unfollow', $follower->follows->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="border-0 text-muted bg-transparent">Following</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', $follower->follows->id) }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="border-0 bg-transparent p-0 text-primary btn-sm text-start">Follow</button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-center">No Followers.</h3>
                @endif
            </div>
        </div>


    </div>
@endsection
