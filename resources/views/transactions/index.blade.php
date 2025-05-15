@extends('layouts.app')

@section('title', 'Daftar Transaksi')
@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Transaksi</h2>
    
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Transaksi
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th width="15%">Tanggal</th>
                        <th width="15%">Jenis</th>
                        <th>Keterangan</th>
                        <th width="20%">Jumlah</th>
                        <th width="20%">Aksi</th> <!-- Lebarkan kolom aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->date->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $transaction->type === 'income' ? 'bg-success' : 'bg-danger' }}">
                                {{ $transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                            </span>
                        </td>
                        <td>{{ $transaction->description }}</td>
                        <td class="{{ $transaction->type === 'income' ? 'text-success' : 'text-danger' }}">
                            Rp {{ number_format($transaction->amount, 2) }}
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('transactions.edit', $transaction->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Hapus transaksi ini?')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection