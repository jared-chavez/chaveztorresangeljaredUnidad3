<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Send the password reset notification.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token, $this->email));
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole($roles): bool
    {
        if (is_string($roles)) {
            return $this->hasRole($roles);
        }

        return in_array($this->role, $roles);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is sales
     */
    public function isSales(): bool
    {
        return $this->hasRole('sales');
    }

    /**
     * Check if user is customer
     */
    public function isCustomer(): bool
    {
        return $this->hasRole('customer');
    }

    /**
     * Get user's role display name
     */
    public function getRoleDisplayName(): string
    {
        return match($this->role) {
            'admin' => 'Administrador',
            'sales' => 'Vendedor',
            'customer' => 'Cliente',
            default => 'Usuario'
        };
    }

    /**
     * Get dashboard route based on role
     */
    public function getDashboardRoute(): string
    {
        return match($this->role) {
            'admin' => '/admin/dashboard',
            'sales' => '/sales/dashboard',
            'customer' => '/dashboard',
            default => '/'
        };
    }
}
