<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalTransactions = auth()->user()->transactions()->count();
        return view('home', compact('totalTransactions'));
    }
}