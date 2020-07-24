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
        session()->flash('success', 'Welcome');
        
        return Inertia::render('Dashboard');
    }
}
