<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Review untuk Film: {{ $movie->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2>Daftar Review untuk Film: {{ $movie->title }}</h2>

        <a href="{{ route('reviews.create', ['movie_id' => $movie->id]) }}" class="btn btn-primary mb-3">Tambah Review</a>

        @foreach($reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Rating: {{ $review->rating }} / 5</h5>
                    <p>{{ $review->review }}</p>
                    <p><strong>User ID:</strong> {{ $review->user_id }}</p>
                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach

    </div>
</body>
</html>
