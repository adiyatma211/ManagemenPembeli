<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\GrupPelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        $showPelanggan = User::all();
       
        return view('ManagmenPelanggan.c_pelanggan', compact('showPelanggan'));
    }
    // public function searcPelanggan(Request $request)
    // {
    //     // Base query with relationships
    //     $query = User::with('grupPembeli.kepala');

    //     // Total records before filtering
    //     $recordsTotal = User::count();

    //     // Apply search filter
    //     if ($request->input('search.value')) {
    //         $search = $request->input('search.value');
    //         $query->where(function ($q) use ($search) {
    //             $q->where('name', 'LIKE', "%{$search}%")
    //               ->orWhere('nik', 'LIKE', "%{$search}%");
    //         });
    //     }

    //     // Apply day filter if present
    //     if ($request->input('filter_hari')) {
    //         $filterHari = $request->input('filter_hari');
    //         $query->where('hari', $filterHari);
    //     }

    //     // Count filtered records
    //     $recordsFiltered = clone $query;
    //     $recordsFiltered = $recordsFiltered->count();

    //     // Sorting
    //     $columns = ['name', 'nik', 'grupPembeli.kepala.name'];
    //     $order = $request->input('order.0.column', 0);
    //     $dir = $request->input('order.0.dir', 'asc');

    //     if (isset($columns[$order])) {
    //         $orderColumn = $columns[$order];

    //         // Handle nested sorting
    //         if (strpos($orderColumn, '.') !== false) {
    //             $relations = explode('.', $orderColumn);
    //             $finalColumn = array_pop($relations);

    //             foreach ($relations as $relation) {
    //                 $query->whereHas($relation);
    //             }

    //             $query->orderBy(function ($q) use ($relations, $finalColumn) {
    //                 $subQuery = $q;
    //                 foreach ($relations as $relation) {
    //                     $subQuery = $subQuery->{$relation};
    //                 }
    //                 return $subQuery->pluck($finalColumn);
    //             }, $dir);
    //         } else {
    //             $query->orderBy($orderColumn, $dir);
    //         }
    //     }

    //     // Pagination
    //     $start = $request->input('start', 0);
    //     $length = $request->input('length', 10);

    //     // Retrieve data
    //     $data = $query->skip($start)->take($length)->get()->map(function ($row, $index) use ($start) {
    //         return [
    //             'no' => $start + $index + 1,
    //             'hari' => $row->hari ?? 'Belum Di Pilih Hari',
    //             'grup' => optional(optional($row->grupPembeli)->kepala)->name ?? 'Tidak ada grup',
    //             'name' => $row->name,
    //             'nik' => $row->nik,
    //             'jumlah_beli_tabung' => $row->jumlah_beli_tabung ?? 'Belum ada data',
    //             'aksi' => "
    //                 <a href='/editpelanggan/{$row->id}' class='btn btn-primary btn-sm'>Edit</a>
    //                 <a href='/deletepelanggan/{$row->id}' class='btn btn-danger btn-sm'>Delete</a>
    //             "
    //         ];
    //     });
        

    //     // Return JSON response
    //     return response()->json([
    //         'draw' => $request->input('draw', 1),
    //         'recordsTotal' => $recordsTotal,
    //         'recordsFiltered' => $recordsFiltered,
    //         'data' => $data
    //     ]);
    // }

    // public function searcPelanggan(Request $request)
    // {
    //     // Base query with relationships
    //     $query = User::select('users.*', 'grup_pelanggans.KepalaPelangganID', 'kepala.name as kepala_name')
    //     ->leftJoin('grup_pelanggans', DB::raw("FIND_IN_SET(users.id, grup_pelanggans.NamaPelangganID)"), '>', DB::raw('0'))
    //     ->leftJoin('users as kepala', 'grup_pelanggans.KepalaPelangganID', '=', 'kepala.id');
    

    
    //     // Total records before filtering
    //     $recordsTotal = User::count();
    
    //     // Apply search filter
    //     if ($request->input('search.value')) {
    //         $search = $request->input('search.value');
    //         $query->where(function ($q) use ($search) {
    //             $q->where('name', 'LIKE', "%{$search}%")
    //               ->orWhere('nik', 'LIKE', "%{$search}%");
    //         });
    //     }
    
    //     // Apply day filter if present
    //     if ($request->input('filter_hari')) {
    //         $filterHari = $request->input('filter_hari');
    //         $query->where('hari', $filterHari);
    //     }
    
    //     // Count filtered records
    //     $recordsFiltered = clone $query;
    //     $recordsFiltered = $recordsFiltered->count();
    
    //     // Sorting
    //     $columns = ['name', 'nik', 'grupPelanggan.NamaPelangganID'];
    //     $order = $request->input('order.0.column', 0);
    //     $dir = $request->input('order.0.dir', 'asc');
    //     if (isset($columns[$order])) {
    //         $query->orderBy($columns[$order], $dir);
    //     }
    
    //     // Pagination
    //     $start = $request->input('start', 0);
    //     $length = $request->input('length', 10);
    
    //     // Retrieve data
    //     $data = $query->skip($start)->take($length)->get()->map(function ($row, $index) use ($start) {
    //         return [
    //             'no' => $start + $index + 1,
    //             'hari' => $row->hari ?? 'Belum Di Pilih Hari',
    //             'grup' => $row->kepala_name ?? 'Tidak ada grup', // Nama kepala grup pelanggan
    //             'name' => $row->name,
    //             'nik' => $row->nik,
    //             'jumlah_beli_tabung' => 'Belum ada data',
    //             'aksi' => "
    //                 <a href='/editpelanggan/{$row->id}' class='btn btn-primary btn-sm'>Edit</a>
    //                 <a href='/deletepelanggan/{$row->id}' class='btn btn-danger btn-sm'>Delete</a>
    //             "
    //         ];
    //     });
        
        
        
    //     dd([
    //         'draw' => $request->input('draw', 1),
    //         'recordsTotal' => $recordsTotal,
    //         'recordsFiltered' => $recordsFiltered,
    //         'data' => $data
    //     ]);
        
    //     // Return JSON response
    //     return response()->json([
    //         'draw' => $request->input('draw', 1),
    //         'recordsTotal' => $recordsTotal,
    //         'recordsFiltered' => $recordsFiltered,
    //         'data' => $data
    //     ]);
    // }
    


    public function searcPelanggan(Request $request)
    {
        $searchValue = $request->input('search.value', '');
        $filterHari = $request->input('filter_hari', '');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
    
        // Query dasar
        $query = User::leftJoin('grup_pelanggans', function ($join) {
            $join->on('users.grupPelanggan', '=', 'grup_pelanggans.KepalaPelangganID')
                ->orWhereRaw('FIND_IN_SET(users.id, grup_pelanggans.NamaPelangganID)');
        })
        ->select(
            'users.id',
            'users.name as nama_pelanggan',
            'users.nik',
            'users.hari',
            'grup_pelanggans.KepalaPelangganID',
            'grup_pelanggans.NamaPelangganID',
            'grup_pelanggans.id as grup_id',
            DB::raw('(SELECT name FROM users WHERE users.id = grup_pelanggans.KepalaPelangganID) as grup_name')
        );
    
        // Filter berdasarkan pencarian
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('users.name', 'LIKE', "%{$searchValue}%")
                      ->orWhere('users.nik', 'LIKE', "%{$searchValue}%");
            });
        }
    
        // Filter berdasarkan hari
        if (!empty($filterHari)) {
            $query->where('users.hari', $filterHari);
        }
    
        // Hitung total records tanpa filter
        $recordsTotal = User::count();
    
        // Hitung total records dengan filter
        $recordsFiltered = $query->count();
    
        // Ambil data dengan paginasi
        $data = $query
            ->offset($start)
            ->limit($length)
            ->get();
    
        // Format Data untuk DataTable
        $formattedData = $data->map(function ($row, $index) use ($start) {
            $grupName = 'Tidak ada grup';
    
            // Cek apakah user adalah anggota grup
            if (!empty($row->NamaPelangganID)) {
                $anggotaArray = explode(',', $row->NamaPelangganID);
                if (in_array($row->id, $anggotaArray)) {
                    $grupName = $row->grup_name ?? 'Tidak ada grup';
                }
            }
    
            // Cek apakah user adalah kepala grup
            if ($row->KepalaPelangganID == $row->id) {
                $grupName = $row->grup_name ?? 'Tidak ada grup';
            }
    
            return [
                'no' => $start + $index + 1,
                'hari' => $row->hari ?? 'Belum Dipilih Hari',
                'grup' => $grupName,
                'name' => $row->nama_pelanggan,
                'nik' => $row->nik,
                'jumlah_beli_tabung' => 'Belum ada data',
                'aksi' => "
                    <a href='/editpelanggan/{$row->id}' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='/deletepelanggan/{$row->id}' class='btn btn-danger btn-sm'>Delete</a>
                ",
            ];
        });
    
        // Return JSON Response
        return response()->json([
            'draw' => $request->input('draw', 1),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $formattedData
        ]);
    }
    


    
    
    



        public function getPelanggan(Request $request)
        {
            $term = $request->input('term');
        $pelanggan = User::where('name', 'LIKE', '%' . $term . '%')
                         ->select('id', 'name as label')
                         ->get()
                         ->toArray();
        return response()->json($pelanggan);
    }

    public function getAllPelanggan()
    {
        $allPelanggan = User::select('id', 'name as text')->get()->toArray();
        return response()->json($allPelanggan);
    }


    public function tambahgruppelanggan(){
        
        return view('ManagmenPelanggan.c_grup_pelanggan');
    }
    public function search(Request $request)
    {
        $search = $request->get('search', '');

        $kepalas = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->whereNull('grupPelanggan') // Filter kepala yang belum memiliki grupPelanggan
            ->take(40)
            ->get();

        return response()->json($kepalas);
    }


    public function pemetaanpelanggan(){
        
        return view('ManagmenPelanggan.c_peta_pelanggan');
    }

    public function tambahpelanggan(){
        return view('ManagmenPelanggan.c_tambah_pelanggan');
    }
    

}
