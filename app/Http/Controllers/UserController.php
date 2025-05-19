<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Dashboard user, tampilkan data user dan transaksi miliknya
    public function dashboard(Request $request)
    {
        $user = $request->user();

        // Ambil transaksi milik user yang login
        $transactions = $user->transactions()->orderBy('created_at', 'desc')->get();

        return view('user.dashboard', compact('user', 'transactions'));
    }
}