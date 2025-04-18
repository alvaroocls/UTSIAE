<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Movie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Daftar Movie</h1>

    <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Tambah Movie</a>

    <div class="row">
      @foreach ($movies as $movie)
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            @if ($movie->poster)
              <img src="{{ asset('storage/' . $movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}" style="height: 300px; object-fit: cover;">
            @else
              <div class="bg-secondary text-white text-center py-5">No Poster</div>
            @endif
            <div class="card-body">
              <h5 class="card-title">{{ $movie->title }}</h5>
              <p class="card-text">
                <strong>Genre:</strong> {{ $movie->genre }}<br>
                <strong>Durasi:</strong> {{ $movie->duration }} menit
              </p>
              <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
