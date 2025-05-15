@extends('layouts.app')

@section('title', 'Edit Transaksi')
@section('content')
<div class="container">
    <h2 class="mb-4">Edit Transaksi</h2>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Jenis Transaksi</label>
                    <select name="type" class="form-select" required>
                        <option value="income" {{ $transaction->type === 'income' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="expense" {{ $transaction->type === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" 
                           name="amount" 
                           class="form-control" 
                           step="0.01" 
                           min="0" 
                           value="{{ $transaction->amount }}" 
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="description" 
                              class="form-control" 
                              rows="3" 
                              required>{{ $transaction->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" 
                           name="date" 
                           class="form-control" 
                           value="{{ $transaction->date->format('Y-m-d') }}" 
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection