@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">

        <div class="col">
            <table class="table">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users->take(8) as $user)
                        @include('admin.users.table-body')
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>

    </div>


@endsection
