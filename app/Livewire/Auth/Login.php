<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required|string|email')]
    public string $email = '';
    #[Rule('required|string')]
    public string $password = '';
    #[Rule('required|string')]
    public string $title = 'Halaman Login';
    public $login;

    public bool $remember = false;

    public function mount(): void
    {
        $this->title = $this->title ?? 'Login';
        if (Auth::check()) {
            $this->redirectTo();
        }
    }

    public function authenticate(): void
    {
        $this->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $key = 'login-attempts:' . Request::ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
                'login' => [
                    'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . RateLimiter::availableIn($key) . ' detik.'
                ],
            ]);
        }

        $loginField = filter_var($this->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::attempt([
            $loginField => $this->login,
            'password' => $this->password,
        ], $this->remember)) {
            RateLimiter::hit($key);

            throw ValidationException::withMessages([
                'login' => ['Email/Username atau password salah.'],
            ]);
        }

        RateLimiter::clear($key);

        $this->redirectTo();
    }

    protected function redirectTo(): void
    {
        redirect()->route('product');
    }

    public function render()
    {
        return view('livewire.auth.login')->title($this->title);
    }
}
