@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Lihat Daftar Pengguna</a>
</div>
@endsection