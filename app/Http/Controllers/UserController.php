<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        // Solo los administradores pueden consultar la gestión de usuarios
        $this->authorize('viewAny', User::class);

        $users = User::query()
            ->orderBy('role')
            ->orderBy('name')
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        // Solo administradores pueden acceder al formulario de alta
        $this->authorize('create', User::class);

        return view('users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        // Crea el usuario con los datos validados por StoreUserRequest
        User::create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user): View
    {
        // Solo administradores pueden acceder a la edición de usuarios
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        // Obtiene los datos validados
        $validated = $request->validated();

        // Si no se introduce contraseña nueva, se conserva la actual
        if (blank($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }
    }
