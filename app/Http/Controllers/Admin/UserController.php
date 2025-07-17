<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'role' => 'required|in:admin,sales,customer',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado exitosamente',
            'user' => $user
        ]);
    }

    public function changeRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // No permitir cambiar el rol del usuario actual
        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes cambiar tu propio rol'
            ], 403);
        }

        $request->validate([
            'role' => 'required|in:admin,sales,customer',
        ]);

        $user->update(['role' => $request->role]);

        return response()->json([
            'success' => true,
            'message' => 'Rol cambiado exitosamente',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // No permitir eliminar el usuario actual
        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'No puedes eliminar tu propia cuenta'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado exitosamente'
        ]);
    }
} 