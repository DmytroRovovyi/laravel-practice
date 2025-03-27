<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist Videos</title>
</head>
<body>
<h1>Playlist Videos</h1>

<ul>
    @foreach ($videos as $video)
        <li>
            <h2>{{ $video['snippet']['title'] }}</h2>
            <p>{{ $video['snippet']['description'] }}</p>

            <!-- Вбудовування відео за допомогою iframe -->
            <iframe width="560" height="315"
                    src="https://www.youtube.com/embed/{{ $video['snippet']['resourceId']['videoId'] }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
            </iframe>
        </li>
    @endforeach
</ul>
</body>
</html>
