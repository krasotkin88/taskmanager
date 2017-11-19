<?php

namespace App\Models;

use Lib\Storage\Database\DataBase;

class Task
{
    public static function getAllTasks()
    {

        $db = DataBase::getConnect();

        $sql = 'SELECT id, title, description, deadline, creator, executor FROM tasks';

        $res = $db->prepare($sql);

        $res->setFetchMode(\PDO::FETCH_ASSOC);

        $res->execute();

        $tasks = [];

        foreach ($res as $row) {
            $tasks[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'deadline' => $row['deadline'],
                'creator' => $row['creator'],
                'executor' => $row['executor'],
            ];
        }
        return $tasks;
    }

    public static function getTasksByUser()
    {
        $db = DataBase::getConnect();

        $sql = 'SELECT id, title, description, deadline, creator, executor FROM tasks WHERE executor='.$_SESSION['user'];

        $res = $db->prepare($sql);

        $res->setFetchMode(\PDO::FETCH_ASSOC);

        $res->execute();

        $tasks = [];

        foreach ($res as $row) {
            $tasks[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'deadline' => $row['deadline'],
                'creator' => $row['creator'],
                'executor' => $row['executor'],
            ];
        }
        return $tasks;
    }

    public static function addTask($title, $description, $deadline, $creator, $executor)
    {
        $db = DataBase::getConnect();

        $sql = 'INSERT INTO tasks (title, description, deadline, creator, executor) 
                VALUES (:title, :description, :deadline, :creator, :executor)';

        $res = $db->prepare($sql);

        $res->bindParam(':title', $title);
        $res->bindParam(':description', $description);
        $res->bindParam(':deadline', $deadline);
        $res->bindParam(':creator', $creator);
        $res->bindParam(':executor', $executor);

        $res->execute();

        header('Location: /');
    }

}