<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;

class TasksController
{
    public function index()
    {

        User::checkLogged();

//        $user = User::getUserById($_SESSION['user']);

        $tasks = Task::getTasksByUser($_SESSION['user']);

        require __DIR__ . '/../Views/task/index.php';
    }


    public function show($id)
    {
        User::checkLogged();



        $executors = User::getAllUsers();

        $task = Task::getTaskById($id);

        var_dump($task);

        require __DIR__ . '/../Views/task/show.php';
    }


    public function create()
    {
        User::checkLogged();

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

    public function destroy($id)
    {
        Task::deleteTaskById($id);

        header('Location: /');
    }

    public function update_deadline($id)
    {
        $deadline = $_POST['deadline'];

        Task::updateTasksDeadlineById($id, $deadline);

        $referrer = $_SERVER['HTTP_REFERER'];

        header('Location:' . $referrer);
    }

    public function update_executor($id)
    {
        $executor_id = $_POST['executor_id'];

        Task::updateTasksExecutorById($id, $executor_id);

        $referrer = $_SERVER['HTTP_REFERER'];

        header('Location:' . $referrer);
    }

}