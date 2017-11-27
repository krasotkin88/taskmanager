<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;

class TasksController
{
    public function index()
    {
        User::checkLogged();

        $user = $_SESSION['user'];

        if (isset($_GET['status'])) {
            $status = $_GET['status'];
        }else{
            $status = 'active';
        }

        $tasks = Task::getTasksByUser($user, $status);

        echo '<pre>';
        var_dump($tasks);
        echo '</pre>';

        require __DIR__ . '/../Views/task/index.php';
    }


    public function show($id)
    {
        User::checkLogged();

        $executors = User::getAllUsers();

        $task = Task::getTaskById($id);

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


    public function updateDeadline($id)
    {
        $deadline = $_POST['deadline'];

        Task::updateTasksDeadlineById($id, $deadline);

        $referrer = $_SERVER['HTTP_REFERER'];

        header('Location:' . $referrer);
    }


    public function updateExecutor($id)
    {
        $executor_id = $_POST['executor_id'];

        Task::updateTasksExecutorById($id, $executor_id);

        $referrer = $_SERVER['HTTP_REFERER'];

        header('Location:' . $referrer);
    }


    public function updateStatus($id)
    {
        $status = $_POST['status'];

        Task::updateTasksStatusById($id, $status);

        header('Location: /');
    }

}