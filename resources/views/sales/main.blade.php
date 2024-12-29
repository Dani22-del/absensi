@extends('components.app')
@section('css')
@endsection
@section('content')
  <div class="row gy-4">
    <h4 class="fw-bold mb-2 py-3">
        Sales
    </h4>
    <div class="main-page card p-3">
        <div class="card-datatable text-nowrap p-3">
            <div class="col-lg-3 col-sm-6 col-12 mb-4">
                <div class="demo-inline-spacing">
                    <div class="btn-group">
                        <button type="button" onclick="addSales()" class="btn btn-sm btn-primary">
                            <i class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru
                        </button>
                    </div>
                </div>
            </div>
            <table id="datagrid" class="table-bordered table" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sales</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="add-sales-page"></div>
    {{-- <div class="detail-driver-page"></div> --}}
  </div>
@endsection

@section('js')
<script>
        $(function() {
        var table = $('#datagrid').DataTable({
            processing: true,
            serverSide: true,
            language: {
                searchPlaceholder: "Ketikkan yang dicari"
            },
            ajax: "{{ route('data-sales') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_sales',
                    name: 'nama_sales',
                    render: function(data, type, row) {
                        return '<p style="color:black">' + data + '</p>';
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        });
    </script>
<script type="text/javascript">
    function addSales() {
        $.post("{!! route('form-add-sales') !!}").done(function(data) {
            if (data.status == 'success') {
                $('.add-sales-page').html('');
                $('.add-sales-page').html(data.content).fadeIn();
                $('#addSales').modal('show'); // Show the modal
            } else {
                $('.main-page').show();
            }
        });
    }
    function editForm(id) {
            $.post("{!! route('form-add-sales') !!}", {
                id: id
            }).done(function(data) {
                if (data.status == 'success') {
                    $('.add-sales-page').html('');
                    $('.add-sales-page').html(data.content).fadeIn();
                    $('#addSales').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function deleteForm(id) {
            Swal.fire({
                title: "Apakah Anda yakin akan menghapus data ini ?",
                text: "Data akan di hapus dan tidak dapat diperbaharui kembali !",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus Data!',
            }).then((result) => {
                if (result.value) {
                    $.post("{!! route('destroy-sales') !!}", {
                        id: id
                    }).done(function(data) {
                        console.log(data)
                        toastr.success(data.success);

                        $('.preloader').show();
                        $('#datagrid').DataTable().ajax.reload();
                    }).fail(function() {
                        toastr.error(data);

                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    toastr.warning(data);

                    $('#datagrid').DataTable().ajax.reload();
                }
            });
        };

    
</script>
@endsection
