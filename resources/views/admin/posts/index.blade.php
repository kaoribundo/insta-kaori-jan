@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <table class="table">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th></th>
                <th>CATEGORY</th>
                <th>OWNER</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td><img src="{{ $post->image }}" alt="" class="img img-fluid" width="150px"></td>
                    <td>
                        @if ($post->categoryPost->isNotEmpty())
                            @foreach ($post->categoryPost as $category)
                                <span class="badge bg-secondary">{{ $category->category->name }}</span>
                            @endforeach
                        @else
                            <span class="badge bg-secondary">Uncategorized</span>
                        @endif

                    </td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if ($post->deleted_at)
                            <i class="fa-solid fa-circle text-secondary"></i> Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary"></i> Visible
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            @if ($post->deleted_at)
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item text-decoration-none text-success"
                                        data-bs-toggle="modal" data-bs-target="#visible-post-{{ $post->id }}"><i
                                            class="fa-solid fa-eye"></i>
                                        &nbsp;Visible {{ $post->id }}</a>
                                </div>
                            @else
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item text-decoration-none text-danger"
                                        data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}"><i
                                            class="fa-solid fa-eye-slash"></i>
                                        &nbsp;Hide {{ $post->id }}</a>
                                </div>
                            @endif

                        </div>
                    </td>
                </tr>
                {{-- modal hide --}}
                <div class="modal fade" id="hide-post-{{ $post->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content border-danger">
                            <div class="modal-header border-danger">
                                <h5 class="modal-title text-danger" id="modalTitleId">
                                    <i class="fa-solid fa-post-slash"></i> Hide Post
                                </h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure to hide this post? PostID:{{ $post->id }}</p>
                                <img src="{{ $post->image }}" alt="" class="img img-fluid" width="150px">
                                <p class="text-muted">{{ $post->description }}</p>

                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('admin.posts.hide', $post->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm">Hide</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- modal visible --}}
                <div class="modal fade" id="visible-post-{{ $post->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content border-success">
                            <div class="modal-header border-success">
                                <h5 class="modal-title text-success" id="modalTitleId">
                                    <i class="fa-solid fa-post-check"></i> Visible Post
                                </h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure to Visible this post? PostID:{{ $post->id }}</p>
                                <img src="{{ $post->image }}" alt="" class="img img-fluid" width="150px">
                                <p class="text-muted">{{ $post->description }}</p>

                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('admin.posts.restore', $post->id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-success btn-sm">Visible</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>

@endsection
