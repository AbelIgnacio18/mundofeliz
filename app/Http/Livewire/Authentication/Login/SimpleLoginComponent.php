<?php

namespace App\Http\Livewire\Authentication\Login;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SimpleLoginComponent extends Component
{
    public $email;
    public $password;
    public $rememberMe = true;


    protected $rules = [
        'email' => ['required', 'email', 'exists:users,email'],
        'password' => ['required', 'min:4', 'max:20'],
    ];

    protected $messages = [
        'email.exists' => 'El correo electrónico no existe en nuestro registro.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {


        if (!app()->environment('production')) {
            $this->email = "test_athon@innovastaff.org";
            $this->password = "";
        }
    }


    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->rememberMe)) {

            return redirect()->route('app.home');
        }
        session()->flash('error', 'Credenciales no válidas');
    }

    public function render()
    {
        return view('livewire.authentication.login.simple-login-component')
            ->extends('layouts.auth')
            ->section('content');
    }
}
