<?php

namespace App\Models;

use Lib\Storage\Database\DataBase;

class User
{
    public static function getAllUsers(){
        $db = DataBase::getConnect();
        $sql = 'SELECT id, username, email, password FROM users';
        $res = $db->prepare($sql);
        $res->execute();

        $users = array();
        foreach ($res as $row){
            $users[]=[
                'id' => $row['id'],
                'username' => $row['username'],
                'email' => $row['email'],
                'password' => $row['password'],
            ];
        }
        return $users;
    }

    public static function getUserById($id){
        $db = DataBase::getConnect();
        $sql = 'SELECT id, username, email, password FROM users WHERE id = :id';
        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, \PDO::PARAM_INT);
        $res->execute();

        $user = $res->fetch();
        return $user;
    }
}