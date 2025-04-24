<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Theater</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Daftar Theater</h1>

    <a href="{{ route('theaters.create') }}" class="btn btn-primary mb-3">Tambah Theater</a>

    <div class="row">
      @foreach ($theaters as $theater)
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">{{ $theater->name }}</h5>
              <p class="card-text">
                <strong>Lokasi:</strong> {{ $theater->location }}<br>
              </p>
              <a href="{{ route('theaters.show', $theater->id) }}" class="btn btn-sm btn-info">Lihat Detail</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
