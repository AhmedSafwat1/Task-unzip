<?php

namespace App\Services;

use App\Models\User as Model;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function login($credentials)
    {
        return Auth::attempt($credentials);
    }

    public function create(array $data)
    {
        return $this->model->create([
          'username' => $data['username'],
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => bcrypt($data['password'])
        ]);
    }

}
