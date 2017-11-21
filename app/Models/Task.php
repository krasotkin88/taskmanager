<?php

namespace App\Models;

use Lib\Storage\Database\DataBase;

class Task
{
    public static function getAllTasks()
    {

        $db = DataBase::getConnect();

        $sql = 'SELECT id, title, description, deadline FROM tasks';

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

    public static function getTasksByUser($user)
    {
        $db = DataBase::getConnect();

        $sql = 'SELECT t.id, t.title, t.description, t.deadline, t.creator, u.username 
                FROM tasks_executors t_e
                INNER JOIN tasks t ON t.id=t_e.task_id
                INNER JOIN users u ON u.id=t_e.user_id
                WHERE t_e.user_id=' . $user;


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
                'executor' => $row['username'],
                'creator' => $row['creator'],
            ];
        }
        return $tasks;
    }

    public static function addTask($title, $description, $deadline, $creator, $executor)
    {
        $db = DataBase::getConnect();

        $sql = 'INSERT INTO tasks (title, description, deadline, creator) 
                VALUES (:title, :description, :deadline, :creator);
                INSERT INTO tasks_executors (task_id, user_id)
                VALUES ((SELECT MAX(id) FROM tasks), :user_id)';

        $res = $db->prepare($sql);

        $res->bindParam(':title', $title);
        $res->bindParam(':description', $description);
        $res->bindParam(':deadline', $deadline);
        $res->bindParam(':creator', $creator);
        $res->bindParam(':user_id', $executor);

        $res->execute();

        header('Location: /');
    }

}