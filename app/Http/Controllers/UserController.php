<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (! auth()->user()->isAdmin() && ! auth()->user()->isManager()) {
            abort(403, 'غير مصرح لك بالوصول لإدارة فريق العمل.');
        }

        $users = User::withCount(['assignedTasks'])
            ->latest()
            ->paginate(15);

        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403, 'عفواً، إضافة موظفين جدد وتحديد صلاحياتهم مقتصرة فقط وحصرياً على صاحب المنصة المدير العام.');
        }

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

        return back()->with('success', 'تمت إضافة عضو الفريق الجديد وتحديد صلاحياته بنجاح.');
    }

    public function update(Request $request, User $user)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403, 'عفواً، تعديل بيانات وصلاحيات الموظفين مقتصرة فقط وحصرياً على صاحب المنصة المدير العام.');
        }

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
        if (! auth()->user()->isAdmin()) {
            return back()->with('error', 'عفواً، حذف الموظفين من النظام مقتصر فقط وحصرياً على صاحب المنصة المدير العام.');
        }

        if ($user->id === auth()->id() || $user->isAdmin()) {
            return back()->with('error', 'لا يمكن حذف حساب صاحب المنصة المدير العام.');
        }

        $name = $user->name;
        $user->delete();

        return back()->with('success', "تم حذف الموظف ({$name}) نهائياً من فريق العمل بنجاح.");
    }
}
