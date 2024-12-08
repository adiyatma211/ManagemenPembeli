@extends('layout.base')
@section('konten')
<!-- HTML -->
<form class="form form-vertical" id="kepalaGrupForm">
    @csrf
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group has-icon-left">
                    <label for="nama-kepala">Nama Kepala</label>
                    <div class="position-relative">
                        <select class="form-control" id="nama-kepala" name="nama_kepala" style="width: 100%;">
                            <option value="" disabled selected>Pilih Nama Kepala</option>
                        </select>
                        <input type="hidden" id="KepalaPelangganID" name="KepalaPelangganID">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                </div>                
            </div>
           
            <div class="col-12">
                <div class="form-group has-icon-left">
                    <label for="nama-pelanggan">Nama Pelanggan</label>
                   <div class="position-relative">
                    <select class="js-example-basic-multiple form-control" name="NamaPelangganID[]" id="nama-pelanggan" multiple="multiple">
                    </select>
                   </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    
        $("#nama-kepala").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('getPelanggan') }}",
                    data: { term: request.term },
                    dataType: "json",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $("#KepalaPelangganID").val(ui.item.id);
            }
        });
    
        $.ajax({
            url: "{{ route('getAllPelanggan') }}",
            dataType: "json",
            success: function(data) {
                var select = $("#nama-pelanggan");
                $.each(data, function(index, item) {
                    select.append(new Option(item.text, item.id));
                });
                select.trigger('change');
            }
        });
    
        $("#kepalaGrupForm").on('submit', function(e) {
            e.preventDefault();

            // Collect selected values and join them into a comma-separated string
            var selectedValues = $('.js-example-basic-multiple').val(); // Get selected values
            var selectedValuesString = selectedValues.join(','); // Join them into a string

            // Add the string to the form data
            var formData = $(this).serialize() + '&NamaPelangganID=' + encodeURIComponent(selectedValuesString);

            $.ajax({
                url: "{{ route('simpankepalagrup') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    alert('Data berhasil disimpan');
                    window.location.href = "{{ route('pelanggan') }}"; // Change 'your.redirect.route' to the desired route name
                    // Reset form atau redirect ke halaman lain
                },
                error: function(xhr, status, error) {
                    console.error("Error submitting form:", xhr.responseText);
                    alert('Terjadi kesalahan saat menyimpan data: ' + xhr.responseText);
                }
            });
        });
    });
    </script>
    <script>
        $(document).ready(function() {
            $('#nama-kepala').select2({
                placeholder: "Pilih Nama Kepala",
                ajax: {
                    url: '/getAllPelangganPemetaan', // Ganti dengan endpoint API untuk mendapatkan data
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term // Term pencarian dari input Select2
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function(item) {
                                return { id: item.id, text: item.name };
                            })
                        };
                    }
                }
            });
        
            // Set nilai hidden input saat item dipilih
            $('#nama-kepala').on('select2:select', function (e) {
                const data = e.params.data;
                $('#KepalaPelangganID').val(data.id); // Set nilai ID ke hidden input
            });
        });
        </script>
        
    
@endsection