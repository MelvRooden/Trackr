<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index($search_role_id = 4, $search_param = null)
    {
        $roles = Role::orderBy('id', 'DESC')->get();

        if ($search_param != null) {
            $users = User::search($search_param)->where('role_id', $search_role_id)->orderBy('name', 'ASC')->paginate(5);
        } else {
            $users = User::where('role_id', $search_role_id)->orderBy('name', 'ASC')->paginate(5);
        }

        return view('userManagement.index', ['users' => $users], ['roles' => $roles]);
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'address' => $request['address'],
            'postcode' => $request['postcode'],
            'city' => $request['city'],
            'role_id' => $request['role_id']
        ]);

        return back()->with('messages.success', 'attributes.user.success.added');
    }
}
