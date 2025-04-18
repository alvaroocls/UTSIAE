<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2>Tambah Review untuk Film: {{ $movie->title }}</h2>

        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">

            <div class="mb-3">
                <label for="movie_title" class="form-label">Judul Film</label>
                <input type="text" name="movie_title" class="form-control" value="{{ $movie->title }}" readonly>
            </div>

            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea name="review" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1-5)</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" required>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" name="user_id" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Review</button>
        </form>

        <a href="{{ route('reviews.index', ['movie_id' => $movie->id]) }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>
</html>
