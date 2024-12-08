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
        return $this->belongsTo(User::class, 'KepalaPelangganID'); // Group head
    }

    public function anggota()
    {
        return $this->belongsToMany(User::class, 'users', 'id', 'id')
                    ->whereIn('id', explode(',', $this->NamaPelangganID)); // Split the string back into an array
    }
}
