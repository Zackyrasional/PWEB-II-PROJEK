@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Transaksi {{ $user->name }}</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Pengguna</a>

    <table class="table table-striped">
        <thead>
            <tr><th>ID</th><th>Jumlah</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach($transactions as $trans)
            <tr>
                <td>{{ $trans->id }}</td>
                <td>{{ $trans->amount }}</td>
                <td>{{ $trans->status }}</td>
                <td>
                    <a href="{{ route('admin.transactions.edit', $trans->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.transactions.delete', $trans->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus transaksi?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection