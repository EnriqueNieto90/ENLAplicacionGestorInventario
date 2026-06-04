<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;

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
}
