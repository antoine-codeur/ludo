<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="registration-form">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <div class="flex">
                <!-- Affichage visuel du nom d'utilisateur avec le suffixe -->
                <div class="flex-1 relative">
                    <x-text-input id="username" class="block w-full pr-12" type="text" name="username" :value="old('username')" required autocomplete="username" />
                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">{{ $usernameId }}</span>
                </div>
            </div>
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>
        
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    {{-- <script>
        // Sélectionnez le formulaire
        const form = document.getElementById('registration-form');

        // Ajoutez un écouteur pour l'événement de soumission du formulaire
        form.addEventListener('submit', function(event) {
            // Récupérez la valeur actuelle du champ username
            let username = document.getElementById('username').value;

            // Récupérez la valeur de usernameId
            const usernameId = document.getElementById('usernameId').value;

            // Si le champ username ne contient pas déjà le suffixe, ajoutez-le
            if (!username.endsWith(usernameId)) {
                // Ajoutez le suffixe à la valeur du champ username
                username += usernameId;

                // Mettez à jour la valeur du champ username
                document.getElementById('username').value = username;
            }
        });

        // Ajoutez un écouteur pour l'événement de réinitialisation du formulaire
        form.addEventListener('reset', function(event) {
            // Réinitialisez le champ username en supprimant le suffixe
            document.getElementById('username').value = oldUsernameValue;
        });

        // Sauvegardez la valeur initiale du champ username
        const oldUsernameValue = document.getElementById('username').value;
    </script> --}}
    
</form>
</x-guest-layout>