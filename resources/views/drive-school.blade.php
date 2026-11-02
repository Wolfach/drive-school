<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveSchool - Автошкола</title>
    <link rel="stylesheet" href="{{ asset('css/drive-school.css') }}">
</head>

<div class="page-wrapper">
    <header>
        <div class="logo">DriveSchool</div>
        
        <div class="header-links">
            <a href="#">Помощь в навигации</a>
            <a href="#">О нас</a>
            <a href="#">Контакты</a>
        </div>
        
        <div class="header-right">
            г. Ульяновск, ул. Пушкина, 1<br>
            
            @auth
                <span style="color: #fff; margin-right: 10px;">Привет, {{ Auth::user()->name }}!</span>
                
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer; font-size: 12px; text-decoration: underline; padding: 0;">
                        Выйти
                    </button>
                </form>
            @else

                <a href="{{ route('login') }}" style="color: #fff; text-decoration: none;">Профиль</a>
                <span style="color: #fff;">|</span>
                <a href="{{ route('register') }}" style="color: #fff; text-decoration: none;">Регистрация</a>
            @endauth
        </div>
    </header>

    <main>
        
        <section class="info-section">
            <h1>Автошкола DriveSchool</h1>
            <p>Мы обучаем вождению с 2010 года. Наши инструкторы — настоящие профессионалы, а автопарк обновляется каждый год. Мы гарантируем качественную подготовку и помощь в сдаче экзаменов в ГИБДД с первого раза.</p>
        </section>

        <section class="categories-section">
            <div class="categories-top-text">Наши категории обучения</div>

            <div class="categories-grid">
                @foreach($categories as $cat)
                <a href="#" class="cat-item">
                    <div class="cat-letter">{{ $cat['letter'] }}</div>
                    <div class="cat-box">
                        {{ $cat['title'] }}<br>
                        <small>{{ $cat['desc'] }}</small>
                    </div>
                </a>
                @endforeach
            </div>
        </section>

        <section class="instructors-section">
            <h2 class="instructors-title">Наши инструкторы</h2>
            
            <div class="instructors-grid">
                @foreach($instructors as $instructor)
                <div class="instructor-card">
                    <div class="photo-placeholder">Фото</div>
                    
                    <div class="instructor-name">{{ $instructor['name'] }}</div>
                    <div class="instructor-exp">{{ $instructor['exp'] }}</div>

                     <div class="auto-image-wrapper">
                        <img src="{{ asset($instructor['car_img']) }}" alt="Учебный автомобиль" class="auto-image">
                    </div>
                    
                    <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                            {!! $i <= $instructor['rating'] ? '★' : '☆' !!}
                        @endfor
                    </div>
                    
                    <button class="more-btn">Подробнее</button>
                </div>
                @endforeach
            </div>
        </section>

    </main>

    <footer>
        DriveSchool © 2026. Все права защищены.<br>
        Телефон: +7 (999) 123-45-67
    </footer>
</div>

</body>
</html>