<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class NewAuthController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        // 1. Валидация данных
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'Пожалуйста, введите ваше имя.',
            'email.required' => 'Укажите вашу почту.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.unique' => 'Пользователь с такой почтой уже зарегистрирован.',
            'password.required' => 'Придумайте пароль.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 2. Попытка сохранить в БД
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            return redirect()->route('login')->with('success', 'Регистрация прошла успешно! Теперь вы можете войти.');

        } catch (QueryException $e) {
            // Ловим ошибку отсутствия БД или таблицы
            return redirect()->back()
                ->withInput()
                ->withErrors(['db_error' => 'База данных не подключена или таблица "users" не создана. Настройте .env и выполните миграции.']);
        }
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        // 1. Валидация
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Введите вашу почту.',
            'email.email' => 'Введите корректный адрес почты.',
            'password.required' => 'Введите пароль.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 2. Попытка входа
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended(route('home'))->with('success', 'Вы успешно вошли в систему!');
            }

            return redirect()->back()->withInput()->withErrors(['auth_error' => 'Неверная почта или пароль.']);

        } catch (QueryException $e) {
            // Ловим ошибку отсутствия БД
            return redirect()->back()
                ->withInput()
                ->withErrors(['db_error' => 'База данных не подключена. Невозможно проверить логин и пароль.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Вы вышли из системы.');
    }
}