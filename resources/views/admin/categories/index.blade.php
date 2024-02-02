@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-10">
            <form action="{{ route('admin.categories.create') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" name="category" id="category" placeholder="Add a category..."
                        class="form-control rounded-1">
                    <button type="submit" class="btn btn-primary ms-1 rounded-1">+ Add</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-2">
            <table class="table text-center border boerder-1">
                <thead class="table-warning">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>COUNT</th>
                        <th>LAST UPDATED</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_categories as $category)

                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    {{ $category->categoryPosts->count() }}
                                </td>
                                <td>
                                    @if ($category->updated_at)
                                        {{ $category->updated_at->diffForHumans() }}
                                    @endif

                                </td>
                                <td class="d-flex flex-start">
                                    <button class="btn btn-outline-warning" data-bs-toggle="modal" tabindex="-1"
                                        data-bs-target="#category-edit-{{ $category->id }}" data-dismiss="modal"><i
                                            class="fa-solid fa-pen"></i></button>

                                    <button class="btn btn-outline-danger ms-2" data-bs-toggle="modal" tabindex="0"
                                        data-bs-target="#category-delete-{{ $category->id }}" data-dismiss="modal"><i
                                            class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="category-delete-{{ $category->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content border-danger">
                                        <div class="modal-header border-danger">
                                            <h5 class="modal-title text-danger"
                                                id="category-deletetitle-{{ $category->id }}">
                                                <i class="fa-solid fa-trash"></i> Delete Category
                                            </h5>
                                        </div>
                                        <form action="{{ route('admin.categories.delete', $category->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete
                                                    <strong>{{ $category->name }}</strong> ?
                                                </p>
                                                <p class="text-muted">
                                                    This action will affect all posts under this category. Posts under
                                                    this
                                                    category will fall Uncategorized.
                                                </p>
                                            </div>
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- modal edit --}}
                            <div class="modal fade" id="category-edit-{{ $category->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content border-warning">
                                        <div class="modal-header border-warning">
                                            <h5 class="modal-title text-dark" id="category-edittitle-{{ $category->id }}">
                                                <i class="fa-solid fa-pen"></i> Edit Category
                                            </h5>
                                        </div>
                                        <form action="{{ route('admin.categories.edit', $category->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <input type="text" name="category" id="category" class="form-control"
                                                    value="{{ $category->name }}">
                                            </div>
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-dismiss="modal"
                                                    data-bs-target="category-edit-{{ $category->id }}">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-warning">
                                                    Update
                                                </button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            {{-- modal delete --}}


                    @endforeach


                    <tr>
                        <td></td>
                        <td>
                            Uncategorized
                            <p class="text-muted">Hidden posts are not included.</p>
                        </td>
                        <td><strong>{{$uncategorized_post}}</strong></td>
                        <td></td>
                        <td></td>

                    </tr>

                </tbody>
            </table>

        </div>
    </div>

@endsection
