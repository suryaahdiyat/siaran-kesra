<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(): View
    {
        // Pastikan nama view-nya adalah 'landing' bukan 'welcome'
        return view('landing');
    }
}