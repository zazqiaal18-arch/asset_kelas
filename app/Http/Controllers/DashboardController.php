<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Kamu bisa mengambil data dari database di sini nantinya
        $title = "Dashboard Utama";

        return view('dashboard', compact('title'));
    }
}
