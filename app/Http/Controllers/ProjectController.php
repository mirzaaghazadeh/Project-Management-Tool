<?php
namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index()
    {
        return response()->json($this->projectRepository->getAllProjects());
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required', 'description' => 'nullable']);
        return response()->json($this->projectRepository->createProject($data));
    }

    public function show($id)
    {
        return response()->json($this->projectRepository->getProjectById($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(['name' => 'required', 'description' => 'nullable']);
        return response()->json($this->projectRepository->updateProject($id, $data));
    }

    public function destroy($id)
    {
        return response()->json($this->projectRepository->deleteProject($id));
    }
}
