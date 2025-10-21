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
                    ->take(10) // Batasi jumlah user yang diambil
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
                    ->take(30) // Batasi jumlah user yang diambil
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
        

        public function resetHari(Request $request)
        {
            try {
                // Validasi CSRF token
                $request->validate([
                    '_token' => 'required',
                ]);
    
                // Update kolom 'hari' menjadi NULL di tabel 'users' (atau tabel lain yang sesuai)
                DB::table('users')->update(['hari' => null]);

                // Hapus semua log copy NIK
                DB::table('nik_copy_logs')->delete();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Hari berhasil direset dan log copy dibersihkan.',
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mereset hari atau log copy.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }

    public function nikCopied(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nik' => 'required|string',
        ]);

        try {
            DB::table('nik_copy_logs')->insert([
                'user_id' => $validated['user_id'] ?? null,
                'nik' => $validated['nik'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

