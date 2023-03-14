<?php

namespace App\Http\Controllers;

use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\DeleteTaskAction;
use App\Actions\Tasks\UpdateTaskAction;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(CreateTaskAction $action)
    {
        return $action->handle();
    }

    public function update(UpdateTaskAction $action)
    {
        return $action->handle();
    }

    public function destroy(DeleteTaskAction $action)
    {
        return $action->handle();
    }
}
