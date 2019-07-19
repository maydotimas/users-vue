<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Symfony\Component\HttpFoundation\Request;

/**
 * Post
 *
 * @mixin Eloquent
 */
class UserController extends Controller
{
    public function get_user_list()
    {
        $users = User::all();
        return response(json_encode($users), 200);
    }

    public function store(CreateUserRequest $request)
    {
        return User::create($request->all(), 200);
    }

    public function edit(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response('User not found', 200);
        } else {
            $user->update($request->all());
            return response('User updated', 200);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response('User not found', 200);
        } else {
            $user->delete();
            return response('User deleted', 200);
        }
    }

    public function multiple_delete(Request $request)
    {
        $ids = array_flatten($request->all());
        User::destroy($ids);
        return response('User deleted', 200);
    }
}
