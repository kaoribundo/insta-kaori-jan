<tr>
    <td>{{ $user->id }}</td>
    <td>
        @if ($user->avatar)
            {{-- <div class="ratio ratio-1x1"> --}}
            <img src="{{ $user->avatar }}" alt="" class="img-fluid rounded rounded-circle avatar-sm" width="48px">
            {{-- </div> --}}
        @else
            <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
        @endif
    </td>
    <td><a href="route{{ route('admin.users.index', $user->id) }}">{{ $user->name }}</a>
    </td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->created_at }}</td>
    <td>
        @if ($user->status == 1)
            <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
        @elseif ($user->status == 0)
            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; InActive
        @endif
    </td>
    <td>
        @if ($user->id != Auth::user()->id)
            <div class="dropdown">
                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                @if ($user->status == 1)
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item text-decoration-none text-danger" data-bs-toggle="modal"
                            data-bs-target="#deactive-user-{{ $user->id }}"><i class="fa-solid fa-user-slash"></i>
                            &nbsp;Deactivate {{ $user->name }}</a>
                    </div>
                @elseif ($user->status == 0)
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item text-decoration-none text-success" data-bs-toggle="modal"
                            data-bs-target="#active-user-{{ $user->id }}"><i class="fa-solid fa-user-check"></i>
                            &nbsp;Activate {{ $user->name }}</a>
                    </div>
                @endif

            </div>
        @endif

    </td>
</tr>

{{-- modal deactivate --}}
<div class="modal fade" id="deactive-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger" id="modalTitleId">
                    <i class="fa-solid fa-user-slash"></i> Deactive User
                </h5>
            </div>
            <div class="modal-body">
                <p>Are you sure to deactivate this user?</p>

            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.users.deactivate', $user->id) }}" method="post">
                    @csrf
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal activate --}}
<div class="modal fade" id="active-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h5 class="modal-title text-success" id="modalTitleId">
                    <i class="fa-solid fa-user-check"></i> Activate User
                </h5>
            </div>
            <div class="modal-body">
                <p>Are you sure to Activate this user?</p>

            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.users.activate', $user->id) }}" method="post">
                    @csrf
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                </form>
            </div>
        </div>
    </div>
</div>
