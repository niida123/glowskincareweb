<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    private array $allowedRoles = ['super_admin', 'admin', 'manager', 'seller', 'customer'];

    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => 'required|in:' . implode(',', $this->allowedRoles),
        ]);

        $isLastSuperAdmin = $user->role === 'super_admin'
            && $data['role'] !== 'super_admin'
            && User::where('role', 'super_admin')->count() === 1;

        if ($isLastSuperAdmin) {
            return back()->withErrors(['role' => 'At least one super admin is required.'])->withInput();
        }

        // Prevent non-super admins from promoting/demoting super admins via request tampering
        if (auth()->user()?->role !== 'super_admin' && $user->role === 'super_admin') {
            abort(403);
        }

        $user->update(['role' => $data['role']]);

        return back()->with('status', 'User role updated.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:' . implode(',', $this->allowedRoles),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Only super admins can create super admins (except bootstrap handled by middleware)
        if ($data['role'] === 'super_admin' && auth()->user()?->role !== 'super_admin') {
            abort(403);
        }

        $createData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ];

        if ($request->hasFile('profile_image')) {
            $createData['profile_image'] = $this->storeProfileImage($request);
        }

        User::create($createData);

        return back()->with('status', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:' . implode(',', $this->allowedRoles),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Prevent non-super admins from editing a super admin
        if (auth()->user()?->role !== 'super_admin' && $user->role === 'super_admin') {
            abort(403);
        }

        // Prevent demoting the last super admin
        $isDemotingLastSuperAdmin = $user->role === 'super_admin'
            && $data['role'] !== 'super_admin'
            && User::where('role', 'super_admin')->count() === 1;

        if ($isDemotingLastSuperAdmin) {
            return back()->withErrors(['role' => 'At least one super admin is required.'])->withInput();
        }

        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
        ];

        if (!empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }

        if ($request->hasFile('profile_image')) {
            $this->deleteProfileImage($user->profile_image);
            $update['profile_image'] = $this->storeProfileImage($request);
        }

        $user->update($update);

        return back()->with('status', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Prevent non-super admins from deleting a super admin
        if (auth()->user()?->role !== 'super_admin' && $user->role === 'super_admin') {
            abort(403);
        }

        // Prevent deleting the last super admin
        $isLastSuperAdmin = $user->role === 'super_admin' && User::where('role', 'super_admin')->count() === 1;
        if ($isLastSuperAdmin) {
            return back()->withErrors(['delete' => 'Cannot delete the last super admin.']);
        }

        // Prevent self-delete to avoid accidental lockout
        if (auth()->id() === $user->id) {
            return back()->withErrors(['delete' => 'You cannot delete your own account.']);
        }

        $this->deleteProfileImage($user->profile_image);
        $user->delete();

        return back()->with('status', 'User deleted.');
    }

    private function storeProfileImage(Request $request): string
    {
        $file = $request->file('profile_image');
        File::ensureDirectoryExists(public_path('storage/profiles'));
        $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/profiles'), $filename);

        return 'profiles/' . $filename;
    }

    private function deleteProfileImage(?string $relativePath): void
    {
        if (!$relativePath) {
            return;
        }

        $absolutePath = public_path('storage/' . ltrim($relativePath, '/'));
        if (File::exists($absolutePath)) {
            File::delete($absolutePath);
        }
    }
}
