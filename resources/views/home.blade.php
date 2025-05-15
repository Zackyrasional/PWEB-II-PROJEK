@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Selamat datang, {{ auth()->user()->name }}!</h2>
    <p>Total transaksi Anda: {{ $totalTransactions }}</p>
</div>
@endsection
