@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Transaksi</h2>

    <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="amount" class="form-control" value="{{ old('amount', $transaction->amount) }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="{{ old('status', $transaction->status) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.users.transactions', $transaction->user_id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection