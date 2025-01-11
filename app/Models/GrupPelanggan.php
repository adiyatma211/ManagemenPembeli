<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupPelanggan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $casts = [
        'KepalaPelangganID' => 'integer', // Ensure this is correctly cast
        // Remove 'NamaPelangganID' casting if it's no longer an array
    ];
    
    public function kepala()
    {
        return $this->belongsTo(User::class, 'KepalaPelangganID');
    }

    public function anggota()
    {
        $ids = explode(',', $this->NamaPelangganID); // Ubah string menjadi array
        return User::whereIn('id', $ids); // Ambil anggota berdasarkan ID
    }

    public function cariAnggota($userId)
    {
        $ids = explode(',', $this->NamaPelangganID);
        return in_array((string)$userId, $ids);
    }
    
}
