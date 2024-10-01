@extends('layout.base')
@section('konten')
<section>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Formulir Tambah Kepala Grup Pelanggan</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Nama Kepala</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Masukan Nama Kepala" id="first-name-icon">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">

                                <div class="form-group has-icon-left">
                                    <label for="email-id-icon">Nik</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Masukan NIK"
                                            id="email-id-icon">
                                        <div class="form-control-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Alamat</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Masukan Alamat"
                                            id="mobile-id-icon">
                                        <div class="form-control-icon">
                                            <i class="bi bi-house"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset"
                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection