<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\CursorPaginator;

class UserController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(){

        $users = $this->user->paginate(8);

        // $users->withPath('/admin/user');

        return view('admin.users.index')->with('users',$users);
    }

    public function deactivate($id)
    {
        $user = $this->user->findOrFail($id);
        $user->status = 0;
        $user->save();

        return redirect()->back();
    }
    public function activate($id)
    {
        $user = $this->user->findOrFail($id);
        $user->status = 1;
        $user->save();

        return redirect()->back();
    }
}
