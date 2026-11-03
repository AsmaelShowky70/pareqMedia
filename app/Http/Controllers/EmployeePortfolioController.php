<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class EmployeePortfolioController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all completed tasks for this employee
        $completedTasks = Task::with(['client', 'project'])
            ->where('assigned_to', $user->id)
            ->where('status', Task::STATUS_COMPLETED)
            ->orderBy('completed_at', 'desc')
            ->paginate(12);

        $totalCompleted = Task::where('assigned_to', $user->id)
            ->where('status', Task::STATUS_COMPLETED)
            ->count();

        $videoCount = Task::where('assigned_to', $user->id)
            ->where('status', Task::STATUS_COMPLETED)
            ->whereIn('department', ['editing', 'video'])
            ->count();

        $designCount = Task::where('assigned_to', $user->id)
            ->where('status', Task::STATUS_COMPLETED)
            ->where('department', 'design')
            ->count();

        $adsCount = Task::where('assigned_to', $user->id)
            ->where('status', Task::STATUS_COMPLETED)
            ->where('department', 'media_buyer')
            ->count();

        // Distinct clients worked with
        $clientsCount = Task::where('assigned_to', $user->id)
            ->where('status', Task::STATUS_COMPLETED)
            ->whereNotNull('client_id')
            ->distinct('client_id')
            ->count('client_id');

        return view('portfolio.employee', compact(
            'user',
            'completedTasks',
            'totalCompleted',
            'videoCount',
            'designCount',
            'adsCount',
            'clientsCount'
        ));
    }
}
