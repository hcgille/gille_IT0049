<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        $users = [
            [
                'username' => 'admin01',
                'full_name' => 'John Ramirez',
                'role' => 'Administrator'
            ],
            [
                'username' => 'cashier01',
                'full_name' => 'Maria Lopez',
                'role' => 'Cashier'
            ],
            [
                'username' => 'cashier02',
                'full_name' => 'Paolo Cruz',
                'role' => 'Cashier'
            ],
            [
                'username' => 'staff01',
                'full_name' => 'Angela Reyes',
                'role' => 'Staff'
            ],
            [
                'username' => 'manager01',
                'full_name' => 'Mark Santos',
                'role' => 'Manager'
            ]
        ];

        return view('users', ['users' => $users]);
    }
}