@extends('layouts.app')

@section('title', 'Tambah Transaksi')
@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Transaksi Baru</h2>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Jenis Transaksi</label>
                    <select name="type" class="form-select" required>
                        <option value="income">Pemasukan</option>
                        <option value="expense">Pengeluaran</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" 
                           name="amount" 
                           class="form-control" 
                           step="0.01" 
                           min="0" 
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="description" 
                              class="form-control" 
                              rows="3" 
                              required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" 
                           name="date" 
                           class="form-control" 
                           value="{{ date('Y-m-d') }}" 
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection