<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\RedirectResponse;

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
}
