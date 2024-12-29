@extends('components.app')
@section('css')
@endsection
@section('content')
  <div class="row gy-4">
    <h4 class="fw-bold mb-2 py-3">
      Customer
    </h4>
    <div class="main-page card p-3">
        <div class="card-datatable text-nowrap p-3">
            <div class="col-lg-3 col-sm-6 col-12 mb-4">
                <div class="demo-inline-spacing">
                    <div class="btn-group">
                        <button type="button" onclick="addCustomer()" class="btn btn-sm btn-primary">
                            <i class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru
                        </button>
                    </div>
                </div>
            </div>
            <table id="datagrid" class="table-bordered table" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Customer</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="add-customer-page"></div>
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
            ajax: "{{ route('data-customer') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_customer',
                    name: 'nama_customer',
                    render: function(data, type, row) {
                        return '<p style="color:black">' + data + '</p>';
                    }
                },
                {
                    data: 'alamat_customer',
                    name: 'alamat_customer',
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
    function addCustomer() {
        $.post("{!! route('form-add-customer') !!}").done(function(data) {
            if (data.status == 'success') {
                $('.add-customer-page').html('');
                $('.add-customer-page').html(data.content).fadeIn();
                $('#addCustomer').modal('show'); // Show the modal
            } else {
                $('.main-page').show();
            }
        });
    }
    function editForm(id) {
            $.post("{!! route('form-add-customer') !!}", {
                id: id
            }).done(function(data) {
                if (data.status == 'success') {
                    $('.add-customer-page').html('');
                    $('.add-customer-page').html(data.content).fadeIn();
                    $('#addCustomer').modal('show'); // Show the modal
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
                    $.post("{!! route('destroy-customer') !!}", {
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
