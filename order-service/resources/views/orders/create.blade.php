@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Pemesanan Tiket</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        <div class="mb-3">
            <label for="user_id">Pilih Pengguna:</label>
            <select class="form-control" name="user_id" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="movie_id">Pilih Film:</label>
            <select class="form-control" name="movie_id" required>
                <option value="">-- Pilih Film --</option>
                @foreach($movies as $movie)
                    <option value="{{ $movie['id'] }}">{{ $movie['title'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity">Jumlah Tiket:</label>
            <input type="number" class="form-control" name="quantity" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Pesan Tiket</button>
    </form>
</div>
@endsection
