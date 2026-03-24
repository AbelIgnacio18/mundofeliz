<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;//importa para que f uncione
// use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellidos',
        'email',
        'password',
        'foto',
        'estado'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

     public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Rol::class, 'user_rols', 'iduser', 'idrol');
    }

     public function hasPermission($permissionName)
    {
        // Obtener todos los permisos asociados al usuario por sus roles
        $permisos = $this->roles()
            ->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('nombre')
            ->toArray();

        return in_array($permissionName, $permisos);
    }
    public function docente()
{
    return $this->hasOne(Docente::class, 'user_id');
}

public function administrativo()
{
    return $this->hasOne(Administrativo::class, 'user_id');
}
// 🔹 ROLES
public function esSuperAdmin()
{
    return $this->roles()->where('nombre', 'SuperAdmin')->exists();
}

public function esAdmin()
{
    return $this->roles()->where('nombre', 'Admin')->exists();
}

public function esDocente()
{
    return $this->roles()->where('nombre', 'Docente')->exists();
}

public function esSecretaria()
{
    return $this->roles()->where('nombre', 'Secretaria')->exists();
}

public function esCaja()
{
    return $this->roles()->where('nombre', 'Caja')->exists();
}


public function tieneRol($rol)
{
    return $this->roles()->where('nombre', $rol)->exists();
}
public function tieneSede($idsede)
{
    return $this->sedes()->where('idsede', $idsede)->exists();
}



public function getSedesIds()
{
    return $this->sedes()->pluck('sedes.id');
}

public function scopePorSede($query, $user)
{
    if ($user->esSuperAdmin()) {
        return $query;
    }

    return $query->whereHas('sedes', function ($q) use ($user) {
        $q->whereIn('sedes.id', $user->getSedesIds());
    });
}


public function esActivo()
{
    return $this->estado == 1;
}
// User.php
public function sedes()
{
    return $this->belongsToMany(
        Sede::class,   // Modelo relacionado
        'user_sedes',  // Nombre de la tabla pivot
        'iduser',     // FK de User en la tabla pivot
        'idsede'      // FK de Sede en la tabla pivot
    );
}
 public function asistenciauserhoy(){
        return $this->hasmany(Asistencia::class,'iduser','id');
    
     }


    
}
