<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all(); // Untuk pilihan di modal/form
        return view('user.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Hapus role lama, pasang role baru
        $user->syncRoles($request->role);

        return back()->with('success', 'Role user ' . $user->name . ' berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Mana bisa hapus akun sendiri, Mas Bro!');
        }
        
        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }
}