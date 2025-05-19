@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Dashboard Pengguna</h1>
    <p>Halo, {{ $user->name }}! Berikut daftar transaksi Anda:</p>

    @if($transactions->isEmpty())
        <p>Tidak ada transaksi.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $trans)
                <tr>
                    <td>{{ $trans->id }}</td>
                    <td>{{ $trans->amount }}</td>
                    <td>{{ $trans->status }}</td>
                    <td>{{ $trans->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection