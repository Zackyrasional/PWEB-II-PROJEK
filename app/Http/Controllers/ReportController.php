<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalIncome = $user->transactions()
            ->where('type', 'income')
            ->sum('amount');
            
        $totalExpense = $user->transactions()
            ->where('type', 'expense')
            ->sum('amount');
            
        $balance = $totalIncome - $totalExpense;
        
        return view('reports.index', compact(
            'totalIncome',
            'totalExpense',
            'balance'
        ));
    }
}