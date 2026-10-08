<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $user = $userModel
            ->where('username', $this->request->getPost('username'))
            ->first();

        if (!$user || !password_verify(
            $this->request->getPost('password'),
            $user['password']
        )) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid username or password.');
        }

        session()->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'logged_in'  => true,
        ]);

        return redirect()->to('/customers');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}