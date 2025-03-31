<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Home page</title>
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
                    <li><a href="/wikipage">Wikipage</a></li>
                    <li><a href="/wikipedia">Wikipedia</a></li>
                    <li><a href="/dashboard">Dashboard</a></li>
                </ul>
            </nav>
        </div>
        <div class="login-nav">
            <nav>
                <ul class="login-menu">
                    @guest
                        <li><a href="/login">login</a></li>
                        <li><a href="/register">register</a></li>
                    @else
                        <li><a href="/profile">profile</a></li>
                    @endguest
                </ul>
            </nav>
        </div>
    </div>
</header>

<main>
    <div class="content container mx-auto">
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
    <div class="sidebar container mx-auto">
        <div class="videos">
            @if(isset($videos['items']) && is_array($videos['items']))
                @foreach ($videos['items'] as $video)
                    <div class="video">
                        @if(isset($video['snippet']['resourceId']['videoId']))
                            <iframe width="350" height="300" src="https://www.youtube.com/embed/{{ $video['snippet']['resourceId']['videoId'] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else
                            <p>No video available.</p>
                        @endif
                    </div>
                @endforeach
            @else
                <p>No videos available.</p>
            @endif
        </div>
    </div>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Laravel practice</p>
</footer>
</body>
</html>
