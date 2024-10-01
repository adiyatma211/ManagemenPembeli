@extends('layout.base')
@section('konten')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                   Tabel Pelanggan 
                </h5>
                <a href="/gruppelanggan" class="btn btn-primary">Tambah Grup Pelanggan</a>
                <a href="/petapelanggan" class="btn btn-primary">Pemetaan Pelanggan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Grup</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Jumlah Beli Tabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Bayu</td>
                                <td>Haris</td>
                                <td>076 4820 8838</td>
                                <td>1</td>
                                <td>
                                    <a href="/petapelanggan" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
@endsection