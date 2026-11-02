@guest
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - DriveSchool</title>
    <link rel="stylesheet" href="{{ asset('css/drive-school.css') }}">
</head>

<div class="page-wrapper" style="min-height: 100vh; display: flex; flex-direction: column;">
    
    <header>
        <div class="logo">DriveSchool</div>
        <div class="header-links">
            <a href="#">Помощь в навигации</a>
            <a href="#">О нас</a>
            <a href="{{ route('home') }}">Главная</a>
        </div>
        <div class="header-right">
            г. Ульяновск, ул. Пушкина, 1<br>
            <a href="{{ route('login') }}" style="color: #fff; text-decoration: none;">Вход</a>
        </div>
    </header>

    <main style="flex: 1; display: flex; justify-content: center; align-items: center; padding: 20px;">
        
        <div class="register-card">
            <div class="register-header">
                <div class="logo-placeholder">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
                    <span style="color: var(--main-red); font-weight: bold;">DriveSchool</span>
                </div>
                <h2>Регистрация</h2>
            </div>

            <div class="register-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    @if ($errors->any())
                        <div style="color: #cc0000; text-align: center; margin-bottom: 15px; font-size: 13px; background-color: #ffcccc; padding: 10px; border-radius: 5px;">
                            @foreach ($errors->all() as $error)
                                <p style="margin: 3px 0;">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label>Подтверждение пароля</label>
                        <input type="password" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="register-btn">Зарегистрироваться</button>
                    
                    <div style="text-align: center; margin-top: 20px; font-size: 14px;">
                        <span style="color: #666;">Уже есть аккаунт?</span> 
                        <a href="{{ route('login') }}" style="color: var(--main-red); text-decoration: none; font-weight: bold;">Войти</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        DriveSchool © 2026. Все права защищены.<br>
        Телефон: +7 (999) 123-45-67
    </footer>
</div>

</body>
</html>
@endguest

@auth
    <script>window.location.href = "{{ route('home') }}";</script>
@endauth