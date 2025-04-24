<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Theater</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Edit Theater</h1>

    <form action="{{ route('theaters.update', $theater->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="name" class="form-label">Nama Theater</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $theater->name) }}" required>
      </div>

      <div class="mb-3">
        <label for="location" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $theater->location) }}" required>
      </div>
      
      <button type="submit" class="btn btn-success">Update</button>

      <a href="{{ route('theaters.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
