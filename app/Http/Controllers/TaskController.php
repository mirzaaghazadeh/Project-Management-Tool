<?php
namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index($projectId)
    {
        return response()->json($this->taskRepository->getTasksByProject($projectId));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:todo,in-progress,done',
        ]);
        return response()->json($this->taskRepository->createTask($data));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:todo,in-progress,done',
        ]);
        return response()->json($this->taskRepository->updateTask($id, $data));
    }

    public function destroy($id)
    {
        return response()->json($this->taskRepository->deleteTask($id));
    }
}
