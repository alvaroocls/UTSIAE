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

    <div class="card mb-4">
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

    {{-- Bagian Orders --}}
    <div class="mb-4">
      <h4>Data Orders</h4>
      @if (count($orders) > 0)
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Jumlah Tiket</th>
              <th>Total Harga</th>
              <th>Tanggal Order</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
              <tr>
                <td>{{ $order['user_id'] }}</td>
                <td>{{ $order['quantity'] }}</td>
                <td>Rp{{ number_format($order['total_price']) }}</td>
                <td>{{ \Carbon\Carbon::parse($order['created_at'])->format('d M Y H:i') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <p class="text-muted">Belum ada order untuk film ini.</p>
      @endif
    </div>

    {{-- Bagian Reviews --}}
    <div class="mb-4">
      <h4>Ulasan / Reviews</h4>
      @if (count($reviews) > 0)
        <ul class="list-group">
          @foreach ($reviews as $review)
            <li class="list-group-item">
              <strong>Rating:</strong> {{ $review['rating'] }}<br>
              <strong>Review:</strong> {{ $review['review'] }}<br>
              <small class="text-muted">User ID: {{ $review['user_id'] }} | {{ \Carbon\Carbon::parse($review['created_at'])->format('d M Y H:i') }}</small>
            </li>
          @endforeach
        </ul>
      @else
        <p class="text-muted">Belum ada ulasan untuk film ini.</p>
      @endif
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
