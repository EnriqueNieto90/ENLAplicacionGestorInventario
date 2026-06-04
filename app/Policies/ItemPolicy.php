<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    public function viewAny(User $user): bool
    {
        // Empleados y administradores pueden consultar el inventario
        return true;
    }

    public function view(User $user, Item $item): bool
    {
        // Empleados y administradores pueden ver artículos
        return true;
    }

    public function create(User $user): bool
    {
        // Solo administradores pueden crear artículos
        return $user->isAdmin();
    }

    public function update(User $user, Item $item): bool
    {
        // Solo administradores pueden modificar artículos
        return $user->isAdmin();
    }

    public function delete(User $user, Item $item): bool
    {
        // Solo administradores pueden dar de baja artículos activos
        return $user->isAdmin() && $item->is_active;
    }

    public function restore(User $user, Item $item): bool
    {
        // Solo administradores pueden rehabilitar artículos inactivos
        return $user->isAdmin() && ! $item->is_active;
    }

    public function adjustStock(User $user, Item $item): bool
    {
        // Solo administradores pueden registrar movimientos sobre artículos activos
        return $user->isAdmin() && $item->is_active;
    }
}
