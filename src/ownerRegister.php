<?php

namespace AuthManager;

use Models\Owner as Owner;

class OwnerRegister extends Owner {

    // Proses registrasi
    public function register($email, $password) {

        // cek ketersediaan email
        if (parent::emailExist($email)) {
            return [
                'success' => false,
                'message' => 'Email telah terdaftar sebelumnya',
            ];
        }

        // cek panjang password min 8 karakter
        if (strlen($password) < 8) {
            return [
                'success' => false,
                'message' => 'Password harus  memiliki setidaknya 8 karakter!',
            ];
        }
        
        // Hash password
        $new_password = password_hash($password, PASSWORD_DEFAULT);
        
        // tambahkan data ke database
        $query = "INSERT INTO owner (email, password) VALUES ('$email', '$new_password')";
        if (!parent::insertData($query)) {
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan data!',
            ];
        }

        return [
            'success' => true,
            'message' => 'Registrasi berhasil',
        ];
    }
}
