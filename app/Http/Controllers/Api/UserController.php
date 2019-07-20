<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Symfony\Component\HttpFoundation\Request;

/**
 * Post
 *
 * @mixin Eloquent
 */
class UserController extends Controller
{

    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function get_user_list()
    {
        $users = $this->user->all();
        return response(json_encode($users), 200);
    }

    public function store(CreateUserRequest $request)
    {
        $result = $this->user->store($request->all());
        return response(json_encode($result), 200);
    }

    public function edit(UpdateUserRequest $request, $id)
    {
        $result = $this->user->update($id, $request->all());
        return response(json_encode($result), 200);
    }

    public function delete($id)
    {
        $result = $this->user->delete($id);
        return response(json_encode($result), 200);
    }

    public function multiple_delete(Request $request)
    {
        $result = $this->user->delete($request->all());
        return response(json_encode($result), 200);
    }
}
