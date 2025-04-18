<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Movie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Edit Movie</h1>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $movie->title) }}" required>
      </div>

      <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $movie->genre) }}" required>
      </div>

      <div class="mb-3">
        <label for="duration" class="form-label">Durasi (menit)</label>
        <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration', $movie->duration) }}" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $movie->description) }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Poster Saat Ini</label><br>
        @if ($movie->poster)
          <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" style="width: 200px; height: auto;">
        @else
          <p class="text-muted">Tidak ada poster.</p>
        @endif
      </div>

      <div class="mb-3">
        <label for="poster" class="form-label">Ganti Poster (Opsional)</label>
        <input type="file" class="form-control" id="poster" name="poster">
      </div>

      
      <button type="submit" class="btn btn-success">Update</button>

      <a href="{{ route('movies.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
