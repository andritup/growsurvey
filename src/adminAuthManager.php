<?php 

namespace AuthManager;

use Models\Admin as Admin;

class AdminAuthManager extends Admin {

    // fungsi login admin
    public function loginUser($username, $password) {
        if (!parent::usernameExist($username)) {
            return [
                'success' => false,
                'message' => 'Username tidak ditemukan!',
            ];
        }

        $user = parent::getUserByUsername($username);

        if (!password_verify($password, $user['password'])) {
            return [
                'success' => false,
                'message' => 'Username dan Password tidak cocok',
            ];
        }

        // Buat Session
        $_SESSION['user'] = $user['id_admin'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = 'admin';

        return [
            'success' => true,
            'message' => 'Login berhasil',
        ];
    }
}
