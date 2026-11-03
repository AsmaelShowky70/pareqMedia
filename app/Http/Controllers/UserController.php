<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['assignedTasks'])
            ->latest()
            ->paginate(15);

        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:50',
            'role' => 'required|in:admin,content_creator,manager,employee',
            'department' => 'required|string',
            'job_title' => 'required|string|max:255',
            'daily_quota' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = true;

        User::create($validated);

        return back()->with('success', 'تمت إضافة الموظف الجديد وتحديد صلاحياته بنجاح.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|string|max:50',
            'role' => 'required|in:admin,content_creator,manager,employee',
            'department' => 'required|string',
            'job_title' => 'required|string|max:255',
            'daily_quota' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->has('is_active');

        $user->update($validated);

        return back()->with('success', 'تم تحديث بيانات وصلاحيات الموظف بنجاح.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'لا يمكن حذف المسؤول الوحيد للنظام.');
        }

        $user->delete();

        return back()->with('success', 'تم حذف الموظف بنجاح.');
    }
}
