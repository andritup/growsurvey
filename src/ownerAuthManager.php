<?php 

namespace AuthManager;

use Models\Owner as Owner;

class OwnerAuthManager extends Owner {

    // fungsi login owner
    public function loginUser($email, $password) {

        // cek ketersediaan email
        if (!parent::emailExist($email)) {
            return [
                'success' => false,
                'message' => 'Email tidak ditemukan!',
            ];
        }

        $user = parent::getUserByEmail($email);

        // cek kesamaan password
        if (!password_verify($password, $user['password'])) {
            return [
                'success' => false,
                'message' => 'Email dan Password tidak cocok',
            ];
        }

        // Buat Session
        $_SESSION['user'] = $user['id_owner'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = 'owner';

        return [
            'success' => true,
            'message' => 'Login berhasil',
        ];
    }
}
