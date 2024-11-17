<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>
<div class="login-container">
    <!-- Register form -->
    <form wire:submit="register">
        <div class="login-box">
            <div class="login-form">
                <a href="#" class="login-logo">
                    <img src="images/logo.svg" alt="Logo" />
                </a>
                <div class="login-welcome">
                    Welcome back, <br />Please create your Vivo admin account.
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input wire:model="email" id="email" class="block mt-1 w-full form-control" type="email" name="email" required autocomplete="username" >
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">Contraseña</label>
                    </div>
                    <input wire:model="password" id="password" class="block mt-1 w-full form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">Confirmar Contraseña</label>
                    </div>
                    <input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full form-control"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="login-form-actions">
                    <button type="submit" class="btn"> <span class="icon"> <i class="bi bi-arrow-right-circle"></i> </span>
                        Registrar</button>
                </div>
            
                <div class="login-form-footer">
                    <div class="additional-link">
                        ¿Ya tienes una cuenta? <a href="#"> Ingresar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>