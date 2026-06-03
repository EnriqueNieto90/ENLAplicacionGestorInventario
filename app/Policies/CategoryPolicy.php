<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        // Empleados y administradores pueden consultar categorías
        return true;
    }

    public function view(User $user, Category $category): bool
    {
        // Empleados y administradores pueden consultar una categoría
        return true;
    }

    public function create(User $user): bool
    {
        // Solo administradores pueden crear categorías
        return $user->isAdmin();
    }

    public function update(User $user, Category $category): bool
    {
        // Solo administradores pueden modificar categorías
        return $user->isAdmin();
    }

    public function delete(User $user, Category $category): bool
    {
        // Solo administradores pueden eliminar categorías
        return $user->isAdmin();
    }
}
