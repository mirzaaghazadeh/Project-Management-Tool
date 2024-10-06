<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function getTasksByProject($projectId)
    {
        return Task::where('project_id', $projectId)->get();
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function updateTask($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask($id)
    {
        return Task::destroy($id);
    }
}
