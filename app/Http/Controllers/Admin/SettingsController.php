<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'system_name' => config('app.name', 'AutoMundo'),
            'system_version' => config('app.version', '1.0.0'),
            'maintenance_mode' => app()->isDownForMaintenance() ? '1' : '0',
            'smtp_server' => config('mail.mailers.smtp.host', 'smtp.sendgrid.net'),
            'contact_email' => config('mail.from.address', 'angeljaredchaveztorres@gmail.com'),
            'session_lifetime' => config('session.lifetime', 120),
            'max_login_attempts' => config('auth.max_attempts', 5),
        ];

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'maintenance_mode' => 'required|in:0,1',
            'session_lifetime' => 'required|integer|min:1|max:1440',
            'max_login_attempts' => 'required|integer|min:1|max:20',
        ]);

        try {
            // Solo actualizar los campos editables
            $settings = [
                'session.lifetime' => $request->session_lifetime,
                'auth.max_attempts' => $request->max_login_attempts,
            ];

            // Guardar en cache para persistencia temporal
            foreach ($settings as $key => $value) {
                Cache::put("config.{$key}", $value, now()->addDays(30));
            }

            // Manejar modo de mantenimiento de forma simple
            if ($request->maintenance_mode === '1') {
                // Activar modo mantenimiento
                Cache::put('maintenance_mode', true, now()->addHours(1));
                $maintenanceMessage = 'Modo de mantenimiento activado';
            } else {
                // Desactivar modo mantenimiento
                Cache::forget('maintenance_mode');
                $maintenanceMessage = 'Modo de mantenimiento desactivado';
            }

            return response()->json([
                'success' => true,
                'message' => 'Configuración actualizada exitosamente. ' . $maintenanceMessage
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la configuración: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getSettings()
    {
        $settings = [
            'system_name' => config('app.name', 'AutoMundo'),
            'system_version' => config('app.version', '1.0.0'),
            'maintenance_mode' => app()->isDownForMaintenance() ? '1' : '0',
            'smtp_server' => config('mail.mailers.smtp.host', 'smtp.sendgrid.net'),
            'contact_email' => config('mail.from.address', 'angeljaredchaveztorres@gmail.com'),
            'session_lifetime' => config('session.lifetime', 120),
            'max_login_attempts' => config('auth.max_attempts', 5),
        ];

        return response()->json($settings);
    }
} 