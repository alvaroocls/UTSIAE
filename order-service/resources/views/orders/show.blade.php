@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pemesanan Tiket</h2>

    <div class="card p-4">
        <p><strong>Nama Pemesan:</strong> {{ $user['name'] }}</p>
        <p><strong>Judul Film:</strong> {{ $movie['title'] }}</p>
        <p><strong>Jumlah Tiket:</strong> {{ $order->quantity }}</p>
        <p><strong>Harga per Tiket:</strong> Rp{{ number_format(40000, 0, ',', '.') }}</p>
        <p><strong>Total Bayar:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
        <p><strong>Waktu Pemesanan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>

        <!-- Tombol Kembali -->
        <a href="{{ route('orders.create') }}" class="btn btn-secondary mt-3">Kembali ke Pemesanan Baru</a>

        <!-- Tombol Tambah Pemesanan Baru -->
        <a href="{{ route('orders.create') }}" class="btn btn-primary mt-3">Tambah Pemesanan Baru</a>
    </div>
</div>
@endsection
