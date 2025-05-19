<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'description',
        'date',
        'status' // jika kamu memang menggunakan status
        
    ];

    // Cast kolom 'date' agar otomatis jadi objek Carbon
    protected $casts = [
        'date' => 'date',
    ];

    // Relasi ke model User (satu transaksi dimiliki oleh satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
