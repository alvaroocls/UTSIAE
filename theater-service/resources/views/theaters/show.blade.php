<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Detail Theater</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <a href="{{ route('theaters.index') }}" class="btn btn-secondary mb-4">← Kembali ke Daftar Theater</a>

    <div class="card mb-4">

      <div class="card-body">
        <h3 class="card-title">{{ $theater->name }}</h3>
        <p class="card-text"><strong>Lokasi:</strong> {{ $theater->location }}</p>

        <a href="{{ route('theaters.edit', $theater->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('theaters.destroy', $theater->id) }}" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>

    {{-- Bagian Film --}}
    <div class="mb-4">
      <h4>Daftar Film</h4>
      @if (!empty($movies))
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Judul Film</th>
            <th>Genre</th>
            <th>Durasi</th>
            <th>Deskripsi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($movies as $movie)
            <tr>
              <td>{{ $movie['title'] ?? $movie->title ?? '-' }}</td>
              <td>{{ $movie['genre'] ?? $movie->genre ?? '-' }}</td>
              <!-- Hapus "Rp" dari durasi -->
              <td>{{ $movie['duration'] ?? $movie->duration ?? '-' }}</td>
              <!-- Hapus "Rp" dari deskripsi -->
              <td>{{ $movie['description'] ?? $movie->description ?? '-' }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p class="text-muted">Belum ada film untuk theater ini.</p>
    @endif
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
