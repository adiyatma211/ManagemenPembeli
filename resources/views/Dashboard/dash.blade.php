@extends('layout.base')
@section('konten')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Ketua Pelanggan</h6>
                                    <h6 class="font-extrabold mb-0">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pelanggan Reguler</h6>
                                    <h6 class="font-extrabold mb-0">183.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pengepul</h6>
                                    <h6 class="font-extrabold mb-0">80.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Saved Post</h6>
                                    <h6 class="font-extrabold mb-0">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!--Laporan Penjualan Pelanggan Harian  -->
                    <section class="section">
                        <div class="card mr-5">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Tabel Penjualan Pelanggan Harian (Hari ini)
                                </h5>
                                <br>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <a href="#" class="btn btn-primary">Lihat Laporan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive datatable-minimal">
                                    <table class="table" id="table2">
                                        <thead style="margin-right:50px;">
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Graiden</td>
                                                <td>vehicula.aliquet@semconsequat.co.uk</td>
                                                <td>076 4820 8838</td>
                                                <td>Offenburg</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="#" class="btn btn-primary">Edit</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="#" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    </section>
                </div>
                <div class="col-12">
                    <!--Laporan Penjualan Pelanggan Harian  -->
                    <section class="section">
                        <div class="card mr-5">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Laporan Penjualan Pelanggan
                                </h5>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Pilih Tanggal</label>
                                                <input type="date" class="form-control flatpickr-range mb-3" placeholder="Select date..">
                                                <a href="#" class="btn btn-primary">Lihat Laporan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive datatable-minimal">
                                    <table class="table" id="table2">
                                        <thead style="margin-right:50px;">
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Graiden</td>
                                                <td>vehicula.aliquet@semconsequat.co.uk</td>
                                                <td>076 4820 8838</td>
                                                <td>Offenburg</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="#" class="btn btn-primary">Edit</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="#" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    </section>
                </div>
                <div class="col-12">
                    <!--Tabel Pelanggan  -->
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                   Tabel Pelanggan 
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive datatable-minimal">
                                    <table class="table" id="table2">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Graiden</td>
                                                <td>vehicula.aliquet@semconsequat.co.uk</td>
                                                <td>076 4820 8838</td>
                                                <td>Offenburg</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="#" class="btn btn-primary">Edit</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="#" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
