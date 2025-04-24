<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Theater</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Tambah Theater</h1>

    <a href="{{ route('theaters.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

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

    <form action="{{ route('theaters.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Nama Theater</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
      </div>

      <div class="mb-3">
        <label for="location" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
