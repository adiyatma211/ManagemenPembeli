<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\GrupPelanggan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;


class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $showPelanggan = User::all();
        return view('ManagmenPelanggan.c_pelanggan', ['showPelanggan' => $showPelanggan]);
    }

    /**
     * Store Pelanggan
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
        ]);

        // dd($tambahPelanggan);

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
    }
    /**
     * Store Pemetaan Pelanggan
     */
    public function storeKepalaGrup(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'KepalaPelangganID' => 'required|exists:users,id',
            'NamaPelangganID' => 'required|string',
        ]);
    
        // Convert the string into an array of user IDs
        $namaPelangganIds = explode(',', $validated['NamaPelangganID']);
    
        // Create a new GrupPelanggan entry
        $kepalaGrup = GrupPelanggan::create([
            'KepalaPelangganID' => $validated['KepalaPelangganID'],
            'NamaPelangganID' => $validated['NamaPelangganID'], // Save as a string
        ]);
    
        // Update each user record for the given NamaPelangganID
        foreach ($namaPelangganIds as $pelangganId) {
            $user = User::find($pelangganId);
            if ($user) {
                // Set the KepalaPelangganID
                $user->grupPelanggan = $validated['KepalaPelangganID']; // Assuming there's a column for KepalaPelangganID
                $user->save(); // Save the user record
            }
        }
    
        return response()->json(['message' => 'Kepala Grup berhasil disimpan'], 201);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Validasi file
        ]);

        try {
            // Import file Excel
            Excel::import(new UsersImport, $request->file('file'));

            return redirect()->back()->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    // public function updateHari(Request $request, $hari)
    // {
    //     $request->validate([
    //         'hari' => 'required|in:Senin,Kamis',
    //     ]);
        
    //     // Log untuk melihat parameter yang diterima
    //     Log::info('Received parameter hari:', ['hari' => $hari]);
    //     Log::info('Received AJAX data:', $request->all());
    
    //     // Aktifkan query log
    //     DB::enableQueryLog();
    
    //     // Validasi parameter hari
    //     if (!in_array($hari, ['Senin', 'Kamis'])) {
    //         return response()->json([
    //             'message' => 'Hari tidak valid.'
    //         ], 400);
    //     }
    
    //     $currentWeekStart = Carbon::now()->startOfWeek();
    //     $currentWeekEnd = Carbon::now()->endOfWeek();
    
    //     // Debugging: Cek kondisi yang digunakan
    //     Log::info('Update Hari Method Debug', [
    //         'hari' => $hari,
    //         'week_start' => $currentWeekStart,
    //         'week_end' => $currentWeekEnd
    //     ]);
    
    //     // Ambil user yang belum punya grup dan hari NULL
    //     $usersWithoutGroup = User::whereNull('grupPelanggan')
    //         ->whereNull('hari')  // Hanya yang hari-nya NULL
    //         ->inRandomOrder()    // Acak
    //         ->take(20)           // Ambil 20 user
    //         ->get();
    
    //     // Ambil user yang sudah punya grup
    //     $usersWithGroup = User::whereNotNull('grupPelanggan')
    //         ->whereNull('hari')  // Hanya yang hari-nya NULL
    //         ->inRandomOrder()    // Acak
    //         ->take(20)           // Ambil 20 user
    //         ->get();
    
    //     // Gabungkan kedua koleksi user
    //     $usersToUpdate = $usersWithoutGroup->merge($usersWithGroup);
    
    //     // Update hari dan waktu
    //     foreach ($usersToUpdate as $user) {
    //         $user->hari = $hari;
    //         $user->updated_at = Carbon::now();
    //         $user->updated_by = NULL;
    //         $user->created_by = NULL;
    
    //         $isSaved = $user->save();
    
    //         // Cek apakah berhasil disimpan
    //         if (!$isSaved) {
    //             Log::error('Failed to update user', ['id' => $user->id]);
    //             return response()->json([
    //                 'message' => 'Terjadi kesalahan saat memperbarui user.',
    //                 'status' => 'error'
    //             ]);
    //         }
    //     }
    
    //     // Reset pada hari Minggu untuk semua user
    //     if (Carbon::now()->isSunday()) {
    //         User::query()->update(['hari' => NULL]); // Reset semua user
    //         Log::info('All users reset on Sunday');
    //     }
    
    //     // Lihat query yang dijalankan
    //     $queries = DB::getQueryLog();
    //     dd($queries); // Hentikan eksekusi untuk melihat query
    
    //     return response()->json([
    //         'message' => "Hari {$hari} berhasil di-generate",
    //         'updated_users' => $usersToUpdate->pluck('id')
        //     ]);
        // }    
        public function updateHari(Request $request)
{
    $hari = $request->get('hari', 'Senin'); // Default hari adalah Senin

    // Validasi input hari
    if (!in_array($hari, ['Senin', 'Kamis'])) {
        return response()->json(['message' => 'Hari tidak valid.'], 400);
    }

    try {
        DB::beginTransaction();

        // Pilih user tanpa grupPelanggan
        $usersWithoutGroup = User::whereNull('grupPelanggan')
            ->whereNull('hari') // Hanya user yang belum di-update
            ->inRandomOrder()
            ->take(20) // Batasi jumlah user yang diambil
            ->get();

            foreach ($usersWithoutGroup as $user) {
                $affectedRows = DB::table('users')
                    ->where('id', $user->id)
                    ->update(['hari' => $hari, 'updated_at' => now()]);
                Log::info("Update user tanpa grupPelanggan ID {$user->id} dengan Query Builder:", ['affectedRows' => $affectedRows]);
            }
            

        Log::info('User tanpa grupPelanggan yang di-update:', ['ids' => $usersWithoutGroup->pluck('id')]);

        // Pilih user dengan grupPelanggan
        $usersWithGroup = User::whereNotNull('grupPelanggan')
            ->whereNull('hari') // Hanya user yang belum di-update
            ->inRandomOrder()
            ->take(8) // Batasi jumlah user yang diambil
            ->get();

            foreach ($usersWithGroup as $user) {
                $affectedRows = DB::table('users')
                    ->where('id', $user->id)
                    ->update(['hari' => $hari, 'updated_at' => now()]);
                Log::info("Update user dengan grupPelanggan ID {$user->id} dengan Query Builder:", ['affectedRows' => $affectedRows]);
            }            

        Log::info('User dengan grupPelanggan yang di-update:', ['ids' => $usersWithGroup->pluck('id')]);

        DB::commit();

        return response()->json([
            'message' => "Hari {$hari} berhasil di-update untuk user terpilih.",
            'usersWithoutGroup' => $usersWithoutGroup->pluck('id'),
            'usersWithGroup' => $usersWithGroup->pluck('id'),
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Terjadi kesalahan saat update hari:', ['error' => $e->getMessage()]);
        return response()->json([
            'message' => 'Terjadi kesalahan saat update hari.',
            'error' => $e->getMessage(),
        ], 500);
    }
}
}
