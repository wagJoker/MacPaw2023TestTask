<?php
class UserController {
    public function registerUser($username) {
        $token = bin2hex(random_bytes(32)); // Генерація токену

        $userModel = new UserModel();
        if ($userModel->registerUser($username, $token)) {
            echo "User registered successfully.";
        } else {
            echo "Error while registering user.";
        }
    }
}