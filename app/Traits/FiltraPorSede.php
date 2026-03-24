<?php
namespace App\Traits;

trait FiltraPorSede
{
    public function scopePorUsuario($query)
    {
        $user = auth()->user();

        if (!$user) return $query;

        if ($user->esSuperAdmin()) return $query;

        $sedes = $user->getSedesIds();

        if ($sedes->isEmpty()) {
            return $query->whereRaw('1 = 0');
        }

        return $query->whereIn('idsede', $sedes);
    }
}