<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa; 

class HelloController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all(); 
        return view('hello', compact('mahasiswas')); 
    }
}