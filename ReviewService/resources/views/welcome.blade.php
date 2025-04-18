<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .film-card {
            transition: all 0.3s ease-in-out;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .film-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .badge-rating {
            background-color: #ffc107;
            font-size: 0.9rem;
        }
        .film-img {
            height: 200px;
            object-fit: cover;
        }
        .review-snippet {
            font-style: italic;
            color: #6c757d;
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

        <h1 class="text-center mb-4">
            🎬 <strong>Review Film</strong>
        </h1>

        <!-- Tombol Tambah Review Film Baru -->
        <div class="mb-4 text-end">
            <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#newReviewModal">
                + Tambah Review Film Baru
            </button>
        </div>

        <div class="row mb-4">
            @forelse ($reviews as $review)
                <div class="col-md-6 col-lg-4">
                    <div class="card film-card mb-4">
                        <img src="https://picsum.photos/seed/{{ $review->id }}/600/400" class="card-img-top film-img" alt="{{ $review->movie_title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $review->movie_title }}</h5>
                            <p class="card-text">
                                <span class="badge badge-rating">
                                    ⭐ {{ $review->rating }} / 5
                                </span>
                                <small class="text-muted ms-2">{{ number_format($review->voters ?? 0) }} penonton</small>
                            </p>

                            <!-- ✅ Tampilkan review -->
                            <p class="review-snippet">“{{ $review->review }}”</p>


                            <div class="mt-3 d-flex gap-2">
                                <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus review ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">Belum ada review film 😢</p>
            @endforelse
        </div>

        <!-- Modal: Berikan Review -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content shadow">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel">Berikan Review untuk <span id="modal-movie-title">Film</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="movie_title" id="movie-title-input">
                            <div class="mb-3">
                                <label class="form-label">Review</label>
                                <textarea name="review" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rating (1-5)</label>
                                <input type="number" name="rating" class="form-control" min="1" max="5" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Kirim Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Tambah Review Baru -->
        <div class="modal fade" id="newReviewModal" tabindex="-1" aria-labelledby="newReviewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content shadow">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newReviewModalLabel">Tambah Review Film Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                        
                            <!-- Dropdown Movie -->
                            <div class="mb-3">
                                <label class="form-label">Pilih Film</label>
                                <select name="movie_id" class="form-select" required>
                                    <option value="">-- Pilih Film --</option>
                                    @foreach ($movies as $movie)
                                        <option value="{{ $movie['id'] }}">{{ $movie['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <!-- Dropdown User -->
                            <div class="mb-3">
                                <label class="form-label">Pilih User</label>
                                <select name="user_id" class="form-select" required>
                                    <option value="">-- Pilih User --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">Review</label>
                                <textarea name="review" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rating (1-5)</label>
                                <input type="number" name="rating" class="form-control" min="1" max="5" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan Review</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        <a href="/home" class="btn btn-secondary mt-4 d-block mx-auto" style="max-width: 200px;">⬅ Kembali ke Beranda</a>
    </div>

    <script>
        // Script isi otomatis modal "Berikan Review"
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
