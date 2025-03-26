<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Головна сторінка</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
</head>
<body>
<header>
    <div class="header">
        <div class="logo">
            <a href="/">
                <img src={{ asset('images/Laravel-Logo.wine.svg') }} alt="Logo" width="100" />
            </a>
            <nav>
                <ul class="main-menu">
                    <li><a href="/">Головна</a></li>
                    <li><a href="/about">Про нас</a></li>
                    <li><a href="/services">Послуги</a></li>
                    <li><a href="/contact">Контакти</a></li>
                </ul>
            </nav>
        </div>
        <div class="login-nav">
            <nav>
                <ul class="login-menu">
                    <li><a href="/login">login</a></li>
                    <li><a href="/register">register</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<main>
    <div class="content">
        <div class="articles">
            @foreach ($articles as $article)
                <div class="article">
                    <h2>{{ $article->title }}</h2>
                    <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image">
                    <p>{{ $article->body }}</p>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $articles->links() }}
        </div>
    </div>
    <div class="sidebar">
        <p>Контент справа</p>
    </div>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Laravel practice</p>
</footer>
</body>
</html>
