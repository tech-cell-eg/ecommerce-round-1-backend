<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Import the Authenticatable class
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements MustVerifyEmail // Extend the Authenticatable class
{ 

    /**
 * @method bool hasRole(string|array $roles)
 * @method void assignRole(string|array $roles)
 * @method void syncRoles(string|array $roles)
 * @method bool hasPermissionTo(string|array $permission)
 */
    use HasRoles;
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasRoles;
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];



    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function uploadImage($image)
    {
        $path = $image->store('images/admins', 'public'); 
        $this->image = $path;
        $this->save();
    }

    public function sendEmailVerification()
    {
        $this->sendEmailVerificationNotification();
    }

    public function role()
    {
        return $this->belongsTo(Role::class); 
    }


}