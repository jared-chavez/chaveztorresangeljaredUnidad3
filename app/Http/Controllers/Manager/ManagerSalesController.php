<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManagerSalesController extends Controller
{
    // Listar todos los vendedores
    public function index()
    {
        $sales = User::where('role', 'sales')->get();
        return response()->json($sales);
    }

    // Crear un nuevo vendedor
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $sales = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'sales',
        ]);
        return response()->json(['message' => 'Vendedor creado', 'sales' => $sales], 201);
    }

    // Ver un vendedor específico
    public function show($id)
    {
        $sales = User::where('role', 'sales')->find($id);
        if (!$sales) {
            return response()->json(['message' => 'Vendedor no encontrado'], 404);
        }
        return response()->json($sales);
    }

    // Actualizar un vendedor
    public function update(Request $request, $id)
    {
        $sales = User::where('role', 'sales')->find($id);
        if (!$sales) {
            return response()->json(['message' => 'Vendedor no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|unique:users,email,' . $sales->id,
            'password' => 'sometimes|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->has('name')) $sales->name = $request->name;
        if ($request->has('email')) $sales->email = $request->email;
        if ($request->has('password')) $sales->password = Hash::make($request->password);
        $sales->save();
        return response()->json(['message' => 'Vendedor actualizado', 'sales' => $sales]);
    }

    // Eliminar un vendedor (NO PERMITIDO para managers)
    public function destroy($id)
    {
        return response()->json([
            'error' => 'Acceso denegado',
            'message' => 'Los managers no pueden eliminar vendedores'
        ], 403);
    }
}
