<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ===============================
    // Autentikasi Admin
    // ===============================

    // Tampilkan form login admin
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(array_merge($credentials, ['role' => 'admin']))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/users');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah, atau Anda bukan admin.',
        ]);
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    // ===============================
    // Dashboard & User Management
    // ===============================

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index() // Alias dari listUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    // ===============================
    // Transaction Management
    // ===============================

    public function userTransactions($id)
    {
        $user = User::findOrFail($id);
        $transactions = Transaction::where('user_id', $id)->get();
        return view('admin.users.transactions', compact('user', 'transactions'));
    }

    public function editTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('admin.transactions.edit', compact('transaction'));
    }

    public function updateTransaction(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $transaction->update($request->only(['amount', 'status']));

        return redirect()->route('admin.users.transactions', $transaction->user_id)
                         ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $userId = $transaction->user_id;
        $transaction->delete();

        return redirect()->route('admin.users.transactions', $userId)
                         ->with('success', 'Transaksi berhasil dihapus.');
    }
}
