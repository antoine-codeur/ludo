<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
{
    // Générez le usernameId
    $usernameId = $this->generateUsernameId();

    // Passez le usernameId à la vue du formulaire
    return view('auth.register', ['usernameId' => $usernameId]);
}

// Méthode pour générer le usernameId
    private function generateUsernameId(): string
    {
        return '#' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        
        $usernameId = $request->input('username') . '#' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'username_id' => $usernameId,
            'password' => Hash::make($request->input('password')), 
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
