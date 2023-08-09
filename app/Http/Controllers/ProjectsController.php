<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        // get currently logged in user
        $user = auth()->user();
        $projects = $user->projects;

        // $project = Project::findOrFail($id);
        return response()->json($projects);
    }
}
