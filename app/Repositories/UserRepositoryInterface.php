<?php


namespace App\Repositories;


interface UserRepositoryInterface
{
    /*Get all users*/
    public function all();

    /* Store User Information */
    public function store($data);

    /* Update User Information */
    public function update($id, $data);

    /* Delete user information */
    public function delete($id);

    /* Delete multiple user information */
    public function delete_multiple($data);
}