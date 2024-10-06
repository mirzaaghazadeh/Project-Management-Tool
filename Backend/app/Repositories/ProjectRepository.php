<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function getAllProjects()
    {
        return Project::with('tasks')->get();
    }

    public function createProject(array $data)
    {
        return Project::create($data);
    }

    public function getProjectById($id)
    {
        return Project::with('tasks')->findOrFail($id);
    }

    public function updateProject($id, array $data)
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return $project;
    }

    public function deleteProject($id)
    {
        return Project::destroy($id);
    }
}
