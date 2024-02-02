@extends('layouts.app')

@section('title')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <h5 class="text-muted mb-3">Suggested</h5>

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
                        <p class="text-muted mb-0">{{ $user->email }}</p>
                        @if ($user->isfollower())
                            <small class="text-muted mt-1">Follows you</small>
                        @else
                            <small class="text-muted mt-1">{{ $user->followers->count() }} followers</small>
                        @endif

                    </div>
                    <div class="col-3">
                        {{-- <form action="{{ route('follow', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Follow</button>

                        </form> --}}

                        @if ($user->id == Auth::user()->id)
                            {{ __('') }}
                        @elseif ($user->isfollowed())
                            <form action="{{ route('unfollow', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary btn-sm">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow', $user->id) }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="btn btn-primary btn-sm">Follow</button>
                            </form>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
