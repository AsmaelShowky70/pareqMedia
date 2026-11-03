<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with(['project', 'creator'])
            ->latest('spent_at')
            ->paginate(15);

        $totalExpenses = Expense::sum('amount');
        $byCategory = [
            'ad_spend' => Expense::where('category', 'ad_spend')->sum('amount'),
            'software_tools' => Expense::where('category', 'software_tools')->sum('amount'),
            'freelancers' => Expense::where('category', 'freelancers')->sum('amount'),
            'equipment' => Expense::where('category', 'equipment')->sum('amount'),
            'office_rent' => Expense::where('category', 'office_rent')->sum('amount'),
            'other' => Expense::where('category', 'other')->sum('amount'),
        ];

        $projects = Project::where('status', 'in_progress')->get();

        return view('expenses.index', compact('expenses', 'totalExpenses', 'byCategory', 'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:0.1',
            'payment_method' => 'required|string',
            'project_id' => 'nullable|exists:projects,id',
            'spent_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $validated['created_by'] = Auth::id();

        Expense::create($validated);

        return back()->with('success', 'تم تسجيل المصروف بنجاح.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return back()->with('success', 'تم حذف بند المصروف بنجاح.');
    }
}
