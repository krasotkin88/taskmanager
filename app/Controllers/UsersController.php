<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public function index(){

        User::checkLogged();

        $user = User::getUserById($_SESSION['user']);

        $users = User::getAllUsers();

        include __DIR__ . '/../Views/user/index.php';
    }

    public function show($id) {

        $user = User::getUserById($id);

        echo $user['username'];
    }

    public function login() {
        $email = '';
        $password = '';

        $errors = false;



        if (isset($_POST['email']) && isset($_POST['password'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $userId = User::checkUserData($email, $password);

            if ($userId == false){
                $errors[] = 'Неправильные данные для входа в систему';
            }else{
                User::auth($userId);
                header('Location: /');
            }
        }

        include __DIR__ . '/../Views/user/auth.php';
    }

    public function logout() {
        session_start();
        unset($_SESSION['user']);
        header('Location: /');
    }

}