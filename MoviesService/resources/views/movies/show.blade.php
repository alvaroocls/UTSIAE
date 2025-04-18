<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Detail Movie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <a href="{{ route('movies.index') }}" class="btn btn-secondary mb-4">← Kembali ke Daftar Movie</a>

    <div class="card">
      @if ($movie->poster)
        <img src="{{ asset('storage/' . $movie->poster) }}" class="card-img-top" style="height: 400px; object-fit: cover;" alt="{{ $movie->title }}">
      @endif

      <div class="card-body">
        <h3 class="card-title">{{ $movie->title }}</h3>
        <p class="card-text"><strong>Genre:</strong> {{ $movie->genre }}</p>
        <p class="card-text"><strong>Durasi:</strong> {{ $movie->duration }} menit</p>
        <p class="card-text"><strong>Deskripsi:</strong> {{ $movie->description }}</p>

        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
