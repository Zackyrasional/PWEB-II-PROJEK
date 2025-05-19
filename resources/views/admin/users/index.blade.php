@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Daftar Pengguna</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr><th>ID</th><th>Nama</th><th>Email</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.users.transactions', $user->id) }}" class="btn btn-info btn-sm">Transaksi</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection