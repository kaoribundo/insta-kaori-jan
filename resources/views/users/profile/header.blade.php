<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">
                    {{ $user->name }}
                </h2>
            </div>
            <div class="col-auto p-2">
                @if ($user->id == Auth::user()->id)
                    <a href="{{ route('profile.edit', $user->id) }}"
                        class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    {{-- <form action="" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                    </form> --}}
                    @if ($user->isfollowed())
                        <form action="{{ route('unfollow', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary btn-sm">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('follow', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-auto">

                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    <strong> {{ $user->posts->count() }} </strong> posts
                </a>
            </div>

            <div class="col-auto">
                <a href="{{ route('profile.follower', $user->id) }}" class="text-decoration-none text-dark">
                    <strong> {{ $user->follows->count() }} </strong> followers
                </a>

            </div>
            <div class="col-auto">
                <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">
                    <strong> {{ $user->followers->count() }} </strong> following
                </a>
            </div>

        </div>

        {{-- <p class="d-inline-flex gap-3">

            <a class="text-decoration-none text-dark" data-bs-toggle="collapse"  aria-expanded="true" href="#posts">
                <strong> {{ $user->posts->count() }} </strong> posts
            </a>


            <a class="text-decoration-none text-dark" data-bs-toggle="collapse"  aria-expanded="false" href="#followers">
                <strong> {{ $user->follows->count() }} </strong> followers
            </a>

            <a class="text-decoration-none text-dark" data-bs-toggle="collapse"  aria-expanded="false" href="#followings">
                <strong> {{ $user->followers->count() }} </strong> following
            </a>

        </p> --}}

    </div>
</div>
