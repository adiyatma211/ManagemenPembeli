@extends('layout.base')
@section('konten')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tabel Pelanggan
                </h5>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <a href="/tambahpelanggan" class="btn btn-primary w-100">Tambah Pelanggan</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="/petapelanggan" class="btn btn-primary w-100">Pemetaan Pelanggan</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button id="load-data" class="btn btn-primary w-100">Tampilkan Data Pelanggan</button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button id="generate-senin" class="btn btn-success w-100">Buat Senin</button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button id="generate-kamis" class="btn btn-success w-100">Buat Kamis</button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button id="reset-hari" class="btn btn-success w-100">Reset SENIN DAN KAMIS!</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Notifikasi Sukses atau Error -->
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Form untuk upload file Excel -->
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" class="form-control" required>
                        <button type="submit" class="btn btn-success">Import Excel</button>
                    </div>
                </form>
                <div class="row mb-5 mt-2">
                    <div class="col-md-4">
                        <label for="filter-hari">Filter Hari:</label>
                        <select id="filter-hari" class="form-select">
                            <option value="">Semua Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Kamis">Kamis</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive datatable-minimal mt-4">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Grup</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Jumlah Beli Tabung</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    {{-- <script>
        $(document).ready(function () {
            // Function to initialize or reinitialize DataTable
            function initializeDataTable(filterDay = '') {
                // Destroy existing DataTable if it exists
                if ($.fn.DataTable.isDataTable('#table2')) {
                    $('#table2').DataTable().destroy();
                }

                // Clear the table body to remove any existing rows
                $('#table2 tbody').empty();

                // Reinitialize DataTable
                $('#table2').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('searcPelanggan') }}', // Ensure the route matches your server-side logic
                        type: 'GET',
                        data: {
                            filter_hari: filterDay // Send filter day as an additional parameter
                        },
                        dataType: 'json',
                        error: function (xhr, error, thrown) {
                            console.error('DataTables Ajax Error:', {
                                xhr: xhr,
                                error: error,
                                thrown: thrown
                            });
                            alert('Failed to load data. Please try again later.');
                        }
                    },
                    columns: [
                        { data: 'no', name: 'no', orderable: false },
                        { data: 'hari', name: 'hari' },
                        { data: 'grup', name: 'grupPembeli.kepala.name' },
                        { data: 'name', name: 'name' },
                        { data: 'nik', name: 'nik' },
                        { data: 'jumlah_beli_tabung', name: 'jumlah_beli_tabung', orderable: false },

                    ],
                    order: [[1, 'asc']],
                    pageLength: 40
                });
            }

            // Button click event to load DataTable
            $('#load-data').on('click', function () {
                initializeDataTable();
            });

            // Filter by day (Senin or Kamis)
            $('#filter-hari').on('change', function () {
                const selectedDay = $(this).val(); // Get the selected day
                initializeDataTable(selectedDay); // Reload DataTable with filter
            });

            $('#generate-senin, #generate-kamis').on('click', function () {
                const hari = $(this).attr('id') === 'generate-senin' ? 'Senin' : 'Kamis';
                console.log('Button Clicked, Hari:', hari);

                $.ajax({
                    url: `/update-hari/${hari}`, // URL ke server untuk update hari
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Token CSRF untuk keamanan
                        hari: hari // Mengirimkan parameter hari ke server
                    },
                    success: function (response) {
                        alert(response.message); // Menampilkan pesan sukses
                        initializeDataTable(); // Reload DataTable dengan data yang baru
                    },
                    error: function (xhr) {
                        console.error('Ajax Error:', xhr);
                        alert('Failed to update data. Please try again.');
                    }
                });
            });
            // Initialize the DataTable when the page loads
            initializeDataTable();
            });
    </script>  --}}
    <script>
        $(document).ready(function() {
            // Function to initialize or reinitialize DataTable
            function initializeDataTable(filterDay = '') {
                // Destroy existing DataTable if it exists
                if ($.fn.DataTable.isDataTable('#table2')) {
                    $('#table2').DataTable().destroy();
                }
                // Clear the table body to remove any existing rows
                $('#table2 tbody').empty();

                // Reinitialize DataTable
                $('#table2').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('searcPelanggan') }}', // Ensure the route matches your server-side logic
                        type: 'GET',
                        data: {
                            filter_hari: filterDay // Send filter day as an additional parameter
                        },
                        dataType: 'json',
                        error: function(xhr, error, thrown) {
                            console.error('DataTables Ajax Error:', {
                                xhr: xhr,
                                error: error,
                                thrown: thrown
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to load data. Please try again later.'
                            });
                        }
                    },
                    columns: [{
                            data: 'no',
                            name: 'no',
                            orderable: false
                        },
                        {
                            data: 'hari',
                            name: 'hari'
                        },
                        {
                            data: 'grup',
                            name: 'grupPembeli.kepala.name'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'nik',
                            name: 'nik',
                            render: function(data, type, row) {
                                return `
                                    <span>${data}</span>
                                    <button class="btn btn-sm btn-outline-secondary copy-nik" data-nik="${data}" title="Copy">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                `;
                            }
                        },
                        {
                            data: 'jumlah_beli_tabung',
                            name: 'jumlah_beli_tabung',
                            orderable: false
                        },
                    ],
                    order: [
                        [1, 'asc']
                    ],
                    pageLength: 40
                });
            }

            // Button click event to load DataTable
            $('#load-data').on('click', function() {
                initializeDataTable();
            });

            // Filter by day (Senin or Kamis)
            $('#filter-hari').on('change', function() {
                const selectedDay = $(this).val(); // Get the selected day
                initializeDataTable(selectedDay); // Reload DataTable with filter
            });

            // Generate buttons for Senin or Kamis
            $('#generate-senin, #generate-kamis').on('click', function() {
                const hari = $(this).attr('id') === 'generate-senin' ? 'Senin' : 'Kamis';
                console.log('Button Clicked, Hari:', hari);

                $.ajax({
                    url: `/update-hari/${hari}`, // URL ke server untuk update hari
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Token CSRF untuk keamanan
                        hari: hari // Mengirimkan parameter hari ke server
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        initializeDataTable(); // Reload DataTable dengan data yang baru
                    },
                    error: function(xhr) {
                        console.error('Ajax Error:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update data. Please try again.'
                        });
                    }
                });
            });

            // Reset hari button
            $('#reset-hari').on('click', function() {
                console.log('Reset Hari Button Clicked');

                $.ajax({
                    url: '/reset-hari', // URL ke server untuk reset hari
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' // Token CSRF untuk keamanan
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        initializeDataTable(); // Reload DataTable dengan data yang baru
                    },
                    error: function(xhr) {
                        console.error('Ajax Error:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to reset data. Please try again.'
                        });
                    }
                });
            });

            // Initialize the DataTable when the page loads
            initializeDataTable();
        });

        $(document).on('click', '.copy-nik', function() {
            const $icon = $(this).find('i'); // Mengambil elemen ikon dalam tombol
            const nik = $(this).data('nik');

            navigator.clipboard.writeText(nik).then(() => {
                // Menampilkan pesan berhasil
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'NIK berhasil disalin: ' + nik,
                    timer: 2000,
                    showConfirmButton: false
                });

                // Mengubah warna ikon menjadi hijau
                $icon.removeClass('text-default').addClass(
                'text-success'); // Pastikan 'text-success' adalah kelas CSS hijau
            }).catch(err => {
                // Menampilkan pesan gagal
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal menyalin NIK',
                    timer: 2000,
                    showConfirmButton: false
                });

                console.error(err);
            });
        });
    </script>
@endsection
{{-- $(document).on('click', '.copy-nik', function() {
    const nik = $(this).data('nik');
    navigator.clipboard.writeText(nik).then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'NIK berhasil disalin: ' + nik,
            timer: 2000,
            showConfirmButton: false
        });
    }).catch(err => {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal menyalin NIK',
            timer: 2000,
            showConfirmButton: false
        });
        console.error(err);
    });
});   --}}
