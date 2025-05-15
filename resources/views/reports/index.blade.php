@extends('layouts.app')

@section('title', 'Laporan Keuangan')
@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Keuangan</h2>
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pemasukan</h5>
                    <h2 class="card-text">Rp {{ number_format($totalIncome, 2) }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pengeluaran</h5>
                    <h2 class="card-text">Rp {{ number_format($totalExpense, 2) }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Saldo Akhir</h5>
                    <h2 class="card-text">Rp {{ number_format($balance, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection