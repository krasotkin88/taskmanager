<?php

namespace App\Controllers;

class TasksController
{
    public function index(){
        require __DIR__.'/../Views/task/index.php';
    }

    public function show($id){
        echo "Task show $id";
    }

}