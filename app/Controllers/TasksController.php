<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;

class TasksController
{
    public function index()
    {

        User::checkLogged();

        $user = User::getUserById($_SESSION['user']);

        $tasks = Task::getTasksByUser();

        require __DIR__.'/../Views/task/index.php';
    }

    public function show($id)
    {
        echo "Task show $id";
    }

    public function create()
    {
        User::checkLogged();

        $user = User::getUserById($_SESSION['user']);

        $executors = User::getAllUsers();

        if ($_POST) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $deadline = $_POST['deadline'];
            $creator = $_SESSION['user'];
            $executor = $_POST['executor'];

            Task::addTask($title, $description, $deadline, $creator, $executor);
        }
        require __DIR__ . '/../Views/task/create.php';
    }

}