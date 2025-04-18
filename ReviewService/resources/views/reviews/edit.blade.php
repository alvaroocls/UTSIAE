<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2>Edit Review</h2>

        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea name="review" class="form-control">{{ $review->review }}</textarea>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1-5)</label>
                <input type="number" name="rating" class="form-control" value="{{ $review->rating }}" min="1" max="5" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Review</button>
        </form>

        <a href="{{ route('reviews.index', ['movie_id' => $review->movie_id]) }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>
</html>
