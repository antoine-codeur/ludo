<?php

namespace App\Rules;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class UsernameChangeCooldownRule implements Rule
{
    public function passes($attribute, $value)
    {
        $user = auth()->user();

        // Convertit la chaîne de caractères en objet Carbon
        $lastUsernameUpdate = Carbon::parse($user->last_username_update);

        // Vérifie si l'utilisateur a déjà modifié son nom d'utilisateur dans les 72 dernières heures
        if ($user->username !== $value && $lastUsernameUpdate && $lastUsernameUpdate->addHours(72)->isFuture()) {
            return false;
        }

        return true;
    }
    public function message()
    {
        return 'You can only change your username once every 72 hours.';
    }
}
