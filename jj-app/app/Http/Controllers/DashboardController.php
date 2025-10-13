<?php

namespace App\Http\Controllers;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $uploads = Upload::where('user_id', Auth::id())->latest()->get();
    return view('dashboard', compact('uploads'));
}
}
