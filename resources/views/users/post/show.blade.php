@extends('layouts.app')

@section('title', 'Show post')

@section('content')
    <div class="row border shadow">
        <div class="col p-0 border-end">
            <img src="{{ $post->image }}" alt="image {{ $post->id }}" class="w-100">
        </div>
        <div class="col-4 px-0 bg-white">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <div class="row aligh-items-center">
                        <div class="col-auto">
                            {{-- avatar --}}
                            <a href="#">
                                @if ($post->user->avatar)
                                    <img src="{{ $post->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user icon-sm text-secondary"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0">
                            {{-- name --}}
                            <a href="#" class="text-decoration-none text-dark">
                                {{ $post->user->name }}
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="dropdown">
                                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                {{-- if you are the owner of the post. you can edit and delete --}}
                                @if ($post->user_id == Auth::user()->id)
                                    <div class="dropdown-menu">
                                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </a>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete-post-{{ $post->id }}">
                                            <i class="fa-regular fa-trash-can"></i>Delete
                                        </button>
                                    </div>
                                @else
                                    <div class="dropdown-menu">
                                        {{-- if youre not the owner, show unfollow button --}}
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#">
                                        </button>
                                        @if ($post->user->isfollowed($post->user->id))
                                            <form action="{{ route('unfollow', $post->user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="border-0 text-danger bg-light ms-2">Unfollow</button>
                                            </form>
                                        @else
                                            <form action="{{ route('follow', $post->user->id) }}" method="post">
                                                @csrf
                                                <button type="submit"
                                                    class="border-0 text-primary bg-light ms-2">Follow</button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            @include('users.post.contents.modals.delete')
                        </div>
                    </div>
                </div>
                <div class="card-body w-100">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            {{-- heart button --}}
                            @if ($post->isLiked())
                                <form action="{{ route('like.delete', $post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn shadow-none icon-sm text-danger">
                                        <i class="fa-solid fa-heart"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('like.store', $post->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn shadow-none icon-sm">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="col-auto px-0">
                            {{-- counter --}}
                            {{ $post->likes->count() }}
                        </div>
                        <div class="col text-end">
                            @if ($post->categoryPost->isNotEmpty())
                                @foreach ($post->categoryPost as $category)
                                    <span class="badge bg-secondary">{{ $category->category->name }}</span>
                                @endforeach
                            @else
                                <span class="badge bg-secondary">Uncategorized</span>
                            @endif
                        </div>
                    </div>
                    <a href="#" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
                    &nbsp; <p class="d-inline fw-light">{{ $post->description }}</p>
                    <p class=" text-muted xsmall">{{ $post->created_at->diffForHumans() }}</p>

                    <div class="mt-3">
                        {{-- show all the comments --}}
                        @if ($post->comments->isNotEmpty())
                            <ul class="list-group mt-2">
                                @foreach ($post->comments as $comment)
                                    <li class="list-group-item border-0 p-0 mb-2">
                                        <a href="#"
                                            class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                                        &nbsp;
                                        <p class="d-inline fw-bold">{{ $comment->body }}</p>

                                        <form action="{{ route('comment.delete', $comment->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <span class="text-muted xsmall">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                            @if ($comment->user->id == Auth::user()->id)
                                                &middot;
                                                <button type="submit"
                                                    class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                                            @endif
                                        </form>
                                    </li>
                                @endforeach

                            </ul>
                        @endif

                        <form action="{{ route('comment.store', $post->id) }}" method="post">
                            @csrf

                            <div class="input-group">
                                <textarea name="body" id="" rows="1" class="form-control"></textarea>
                                <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endsection
