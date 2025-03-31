<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Article Titles</title>
</head>
<body>
<h1>Download file with article titles</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@elseif(session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif

<form action="{{ route('titles.fetch') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title_file">Select header file:</label>
    <input type="file" name="title_file" id="title_file" required>
    <button type="submit">Download</button>
</form>
</body>
</html>
