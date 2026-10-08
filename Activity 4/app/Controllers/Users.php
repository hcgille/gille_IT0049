<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data['users'] = $userModel->findAll();

        return view('users', $data);
    }

    public function new()
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'full_name' => 'required',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $hashedPassword = password_hash(
            $this->request->getPost('password'),
            PASSWORD_DEFAULT
        );

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'password'  => $hashedPassword,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $userModel->insert($data);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('users/edit', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Validate required fields
        $rules = [
            'username'  => 'required',
            'full_name' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $newUsername = $this->request->getPost('username');

        // Check username uniqueness if username was changed
        if ($newUsername !== $user['username']) {

            $existingUser = $userModel
                ->where('username', $newUsername)
                ->first();

            if ($existingUser) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', [
                        'username' => 'The username is already in use.'
                    ]);
            }
        }

        $newPassword = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($newPassword !== '') {

            $passwordRules = [
                'password' => 'required|min_length[8]',
                'confirm_password' => 'required|matches[password]',
            ];

            if (!$this->validate($passwordRules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

        } elseif ($confirmPassword !== '') {

            return redirect()->back()
                ->withInput()
                ->with('errors', [
                    'password' => 'Enter a new password before confirming it.'
                ]);
        }

        // Keep existing avatar by default
        $avatarName = $user['avatar'] ?? null;

        // Get uploaded avatar
        $avatar = $this->request->getFile('avatar');

        // Check whether a new avatar was uploaded
        if ($avatar && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {

            // Validate uploaded avatar
            $avatarRules = [
                'avatar' => [
                    'label' => 'Profile Picture',
                    'rules' => [
                        'uploaded[avatar]',
                        'is_image[avatar]',
                        'mime_in[avatar,image/jpg,image/jpeg,image/png]',
                        'max_size[avatar,2048]',
                    ],
                ],
            ];

            if (!$this->validateData([], $avatarRules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            if ($avatar->isValid() && !$avatar->hasMoved()) {

                // Generate a safe random filename
                $avatarName = $avatar->getRandomName();

                // Temporarily store the original upload
                $tempPath = WRITEPATH . 'uploads/' . $avatarName;

                $avatar->move(
                    WRITEPATH . 'uploads',
                    $avatarName
                );

                // Create a display-ready 300 x 300 version
                \Config\Services::image()
                    ->withFile($tempPath)
                    ->fit(300, 300, 'center')
                    ->save(
                        FCPATH . 'uploads/avatars/' . $avatarName
                    );

                // Delete temporary original
                if (file_exists($tempPath)) {
                    unlink($tempPath);
                }

                // Delete previous avatar
                if (!empty($user['avatar'])) {

                    $oldAvatar =
                        FCPATH . 'uploads/avatars/' . $user['avatar'];

                    if (file_exists($oldAvatar)) {
                        unlink($oldAvatar);
                    }
                }
            }

        } elseif ($this->request->getPost('remove_avatar') == '1') {

            // No new image was uploaded, but user wants
            // to remove the existing avatar

            if (!empty($user['avatar'])) {

                $oldAvatar =
                    FCPATH . 'uploads/avatars/' . $user['avatar'];

                if (file_exists($oldAvatar)) {
                    unlink($oldAvatar);
                }
            }

            // NULL causes the placeholder to be displayed
            $avatarName = null;
        }

        // Update the database
        $updateData = [
            'username'  => $newUsername,
            'full_name' => $this->request->getPost('full_name'),
            'avatar'    => $avatarName,
        ];

        // Update password only if a new one was entered
        if ($newPassword !== '') {
            $updateData['password'] = password_hash(
                $newPassword,
                PASSWORD_DEFAULT
            );
        }

        $userModel->update($id, $updateData);

        return redirect()->to('/users');
    }
}