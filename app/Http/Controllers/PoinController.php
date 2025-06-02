<?php
// filepath: app/Http/Controllers/PoinController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoinController extends Controller
{
    public function index()
    {
        return view('anggota.poin');
    }
}