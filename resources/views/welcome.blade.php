<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .film-card {
            transition: transform 0.3s ease-in-out;
        }
        .film-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="p-4">
    <div class="container">
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        <h1 class="text-center mb-4">Review Film</h1>

        <h2>Daftar Film yang Sudah Di Review</h2>
        <div class="row mb-4">
            <!-- Card untuk Film A -->
            <div class="col-md-4">
                <div class="card film-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Film A">
                    <div class="card-body">
                        <h5 class="card-title">Film A</h5>
                        <p class="card-text">
                            Rating: <strong>4.67</strong> / 10.000 orang
                        </p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-movie="Film A">Berikan Review</button>
                    </div>
                </div>
            </div>
            <!-- Card untuk Film B -->
            <div class="col-md-4">
                <div class="card film-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Film B">
                    <div class="card-body">
                        <h5 class="card-title">Film B</h5>
                        <p class="card-text">
                            Rating: <strong>3.95</strong> / 8.500 orang
                        </p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-movie="Film B">Berikan Review</button>
                    </div>
                </div>
            </div>
            <!-- Card untuk Film C -->
            <div class="col-md-4">
                <div class="card film-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Film C">
                    <div class="card-body">
                        <h5 class="card-title">Film C</h5>
                        <p class="card-text">
                            Rating: <strong>5.00</strong> / 15.000 orang
                        </p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-movie="Film C">Berikan Review</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk review -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel">Berikan Review untuk <span id="modal-movie-title">Film</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="movie_title" id="movie-title-input">
                            <div class="mb-3">
                                <label for="review" class="form-label">Review</label>
                                <textarea name="review" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating (1-5)</label>
                                <input type="number" name="rating" class="form-control" min="1" max="5" required>
                            </div>

                            <button type="submit" class="btn btn-success">Kirim Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="/home" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
    </div>

    <script>
        // Mengubah title dan hidden input movie_title berdasarkan film yang dipilih
        var reviewButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
        reviewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var movieTitle = button.getAttribute('data-movie');
                document.getElementById('modal-movie-title').textContent = movieTitle;
                document.getElementById('movie-title-input').value = movieTitle;
            });
        });
    </script>
</body>
</html>
