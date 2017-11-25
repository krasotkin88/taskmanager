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


    public static function getTaskById($id)
    {
        $db = DataBase::getConnect();

        $sql = 'SELECT t.id, t.title, t.description, t.deadline, t.creator, u.username, u.fullname
                FROM tasks_executors t_e
                INNER JOIN tasks t ON t_e.task_id = t.id
                INNER JOIN users u ON t_e.user_id = u.id
                WHERE t_e.task_id=' . $id;

        $res = $db->prepare($sql);
        $res->setFetchMode(\PDO::FETCH_ASSOC);
        $res->execute();

        $task = $res->fetch();

        return $task;
    }


    public static function getTasksByUser($user, $status='active')
    {
        $db = DataBase::getConnect();

        $sql = 'SELECT t.id, t.title, t.description, t.deadline, t.creator, t.status, u.username 
                FROM tasks_executors t_e
                INNER JOIN tasks t ON t.id=t_e.task_id
                INNER JOIN users u ON u.id=t_e.user_id
                WHERE t_e.user_id=' . $user
                . ' AND t.status=' . "\"$status\"";

        $res = $db->prepare($sql);
        $res->setFetchMode(\PDO::FETCH_ASSOC);
        $res->execute();

        $tasks = [];

        $count = 0;

        foreach ($res as $row) {
            $tasks[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'deadline' => $row['deadline'],
                'executor' => $row['username'],
                'creator' => $row['creator'],
            ];
            $count++;
        }

        $tasks['count'] = $count;

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


    public static function deleteTaskById($id)
    {
        $db = DataBase::getConnect();

        $sql = 'DELETE FROM tasks WHERE id = :id';

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, \PDO::PARAM_INT);
        $res->execute();
    }


    public static function updateTasksDeadlineById($id, $deadline)
    {
        $db = DataBase::getConnect();

        $sql = 'UPDATE tasks 
                SET
                deadline = :deadline
                WHERE id = :id';

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, \PDO::PARAM_INT);
        $res->bindParam(':deadline', $deadline);
        $res->execute();
    }


    public static function updateTasksExecutorById($id, $executor_id)
    {
        $db = DataBase::getConnect();

        $sql = 'UPDATE tasks_executors 
                SET
                user_id = :user_id
                WHERE task_id = :id';

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, \PDO::PARAM_INT);
        $res->bindParam(':user_id', $executor_id, \PDO::PARAM_INT);
        $res->execute();
    }

    public static function updateTasksStatusById($id, $status)
    {
        $db = DataBase::getConnect();

        $sql = 'UPDATE tasks
                SET
                status = :status
                WHERE id = :id';

        $res = $db->prepare($sql);
        $res->bindParam(':status', $status, \PDO::PARAM_STR);
        $res->bindParam(':id', $id, \PDO::PARAM_STR);
        $res->execute();
    }
}