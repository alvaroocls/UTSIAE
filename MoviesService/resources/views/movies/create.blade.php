<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Movie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Tambah Movie</h1>

    <a href="{{ route('movies.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Terjadi kesalahan!</strong>
        <ul class="mb-0 mt-2">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
      </div>

      <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre') }}" required>
      </div>

      <div class="mb-3">
        <label for="duration" class="form-label">Durasi (menit)</label>
        <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration') }}" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
      </div>

      <div class="mb-3">
        <label for="poster" class="form-label">Poster (opsional)</label>
        <input type="file" class="form-control" id="poster" name="poster" accept="image/*">
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
