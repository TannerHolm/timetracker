<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
// tasks
use App\Models\Task;

class TimeSheetController extends Controller
{
    public function index(Request $request): Response
    {

        $user = Auth::user();
        $entries = $user->entries()->get();

        
        // loop through the entries and format the created_at date
        foreach ($entries as $entry) {
            $entry->date = $entry->created_at->format('m-d-y');
            // get the name of the task by the id found on the entry
            $entry->task = Task::find($entry->task_id)->name;
        }

        // get all the dates of the current week, in key value pair with the name of the day
        $week = [
            'Monday' => now()->startOfWeek()->format('m-d-y'),
            'Tuesday' => now()->startOfWeek()->addDays(1)->format('m-d-y'),
            'Wednesday' => now()->startOfWeek()->addDays(2)->format('m-d-y'),
            'Thursday' => now()->startOfWeek()->addDays(3)->format('m-d-y'),
            'Friday' => now()->startOfWeek()->addDays(4)->format('m-d-y'),
            'Saturday' => now()->startOfWeek()->addDays(5)->format('m-d-y'),
            'Sunday' => now()->startOfWeek()->addDays(6)->format('m-d-y'),
        ];
        // get the current date, with the full name of the day in key value pair
        $today = [
            'name' => now()->format('l'),
            'date' => now()->format('m-d-y'),
        ];

        $projects = $user->projects;

        return Inertia::render('TimeSheet', [
            'today' => $today,
            'projects' => $projects,
            'week' => $week,
            'entries' => $entries,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function create(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'hours' => 'required|numeric|min:0.5', // Adjust validation rules as needed
        ]);
        
        // Create and store the time entry
        $timeEntry = TimeEntry::create($validatedData);
        
        return response()->json(['message' => 'Time entry created successfully']);
    }

}
