<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagesController extends Controller
{
    public function base(){
        return view('layout.base');
    }
    public function dashboard(){
        return view('Dashboard.dash');
    }


    // Pelanggan
    public function pelangandash(){
        return view('ManagmenPelanggan.c_pelanggan');
    }

    public function tambahgruppelanggan(){
        return view('ManagmenPelanggan.c_grup_pelanggan');
    }

    public function pemetaanpelanggan(){
        return view('ManagmenPelanggan.c_peta_pelanggan');
    }

}
