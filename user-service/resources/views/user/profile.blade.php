<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- CDN Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Optional: Custom styles -->
    <style>
        .card-header h5 {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <!-- Profil User -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5>Profil User</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Name:</strong>
                        <p class="text-muted">{{ $user->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Histori Pemesanan -->
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5>Order History</h5>
            </div>
            <div class="card-body">
                @if(count($orders) > 0)
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Movie Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order['id'] }}</td>
                                    <td>{{ $order['movie_name'] ?? 'Unknown' }}</td>
                                    <td>{{ $order['quantity'] }}</td>
                                    <td>{{ number_format($order['total_price'], 2) }}</td>
                                    <td>
                                        <span class="badge {{ $order['status'] == 'completed' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($order['status']) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <strong>Info!</strong> Belum ada histori pemesanan.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- CDN Bootstrap JS (untuk interaktivitas seperti dropdowns, modals, dll) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
