<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($userId);
    public function getUserByEmail($userEmail);
    public function deleteUser($userId);
    public function createUser(array $userDetails);
    public function searchUserA01($request);
    public function getListPosition();
    public function getInfoUser($id);
    public function updateUserA02($request, $id);
    public function updatePasswordUserA02($request, $id);
    public function deleteUserA02($id);
}
