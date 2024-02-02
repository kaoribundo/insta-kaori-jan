@extends('layouts.app')

@section('title')


@section('content')
    @include('users.profile.header')

    <div style="margin-top:100px">

        <div class="row justify-content-center  mt-2" id="followings">
            <div class="col-5">

                @if ($user->followers->isNotEmpty())
                    <h2 class="mb-3 text-center">Followings</h2>
                    @foreach ($user->followers as $following)
                        <div class="row align-items-center mb-3">
                            <div class="col-2">
                                @if ($following->followee->avatar)
                                    <img src="{{ $following->followee->avatar }}" alt=""
                                        class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary fa-2x"></i>
                                @endif
                            </div>
                            <div class="col-7 ps-0 text-truncate">
                                <a href="{{ route('profile.show', $following->followee->id) }}"
                                    class="text-secondary text-dark fw-bold text-decoration-none">{{ $following->followee->name }}</a>
                            </div>
                            <div class="col-3">
                                <form action="{{ route('unfollow', $following->followee->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="border-0 text-muted bg-transparent">Following</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-center">No Followings.</h3>
                @endif

            </div>
        </div>

    </div>
@endsection
