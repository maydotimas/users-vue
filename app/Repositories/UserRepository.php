<?php


namespace App\Repositories;
use App\Repositories\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function all(){
        return User::all();
    }

    public function store($data){
        return User::create($data);
    }

    public function update($id,$data){
        return User::find($id)->update($data);

    }

    public function delete($id){
         return User::destroy($id);
    }

    public function delete_multiple($data)
    {
        return User::destroy($data);
    }

}