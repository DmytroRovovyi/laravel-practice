<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>wikipedia</title>
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
                    <li><a href="/about">Про нас</a></li>
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
<div class="container mx-auto">
    <form action="{{ route('wikipedia') }}" method="GET" class="container mx-auto">
        <input type="text" name="query" value="{{ $query ?? '' }}" placeholder="Search" class="p-2 border border-gray-400 rounded w-1/2">
        <button type="submit" class="mt-4 px-6 py-2 bg-yellow-500 text-white font-semibold rounded-lg border-2 border-yellow-700 shadow-md hover:bg-yellow-600 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-75">
            Search
        </button>
    </form>
</div>
<main>
    <div class="content container mx-auto">
        <div class="articles">
            @if(isset($wikipedias) && count($wikipedias) > 0)
                @foreach ($wikipedias as $wikipedia)
                    <div class="article">
                        <a href="https://en.wikipedia.org/?curid={{ $wikipedia['pageid'] }}" class="text-blue-600 hover:underline text-xl" target="_blank">
                            {{ $wikipedia['title'] }}
                        </a>
                        <p>{{ strip_tags($wikipedia['snippet']) }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="sidebar container mx-auto">
        <div class="videos">
            @if(isset($videos) && count($videos) > 0)
                <div class="video">
                    @foreach ($videos as $video)
                        <div class="video">
                            @if(isset($video['id']['videoId']))
                                <iframe width="350" height="300" src="https://www.youtube.com/embed/{{ $video['id']['videoId'] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Laravel practice</p>
</footer>
</body>
</html>
