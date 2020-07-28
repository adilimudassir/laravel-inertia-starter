<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function __invoke()
    {
        $name = auth()->user()->name;
        
        session()->flash('success', "Welcome, $name");
        
        return Inertia::render('Dashboard');
    }
}
