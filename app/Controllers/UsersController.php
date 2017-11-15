<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public function index(){
        $users = User::getAllUsers();
        echo "<pre>";
        foreach ($users as $user){
            echo $user['username'];
            echo " ";
            echo $user['email'];
            echo "<br/>";
        }
        echo "</pre>";
    }

    public function show($id){
        $user = User::getUserById($id);
        echo $user['username'];
    }
}