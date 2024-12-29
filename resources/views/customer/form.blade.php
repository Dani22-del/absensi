<div class="modal fade" id="addCustomer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">{{$data? "Edit Customer" : "Tambah Customer"}}</h3>
                    <p class="address-subtitle">Isi dengan lengkap form berikut ini</p>
                </div>
                <form class="row g-4 form-save" onsubmit="return false">
                    <input type="hidden" value="{{ $data ? $data->id_customer : null }}" name="id">
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="nama_customer" name="nama_customer"
                                value="{{ $data ? $data->nama_customer : null }}" class="form-control"
                                placeholder="Nama Customer" />
                            <label for="nama_customer">Nama Customer *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="alamat_customer" name="alamat_customer"
                                value="{{ $data ? $data->alamat_customer : null }}" class="form-control"
                                placeholder="alamat customer" />
                            <label for="alamat_customer">alamat customer *</label>
                        </div>
                    </div>
                   
                    <div class="col-12 text-end">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close"><i class="mdi mdi-keyboard-return me-1"></i>Cancel</button>
                        <button type="button" class="btn btn-success me-sm-3 btn-submit me-1"><i
                                class="mdi mdi-check-all me-1"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
<script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
<script>
    $('.btn-submit').click(function(e) {
        e.preventDefault();
        // $('.btn-submit').html('Please wait...').attr('disabled', true);
        $('.btn-submit');
        var data = new FormData($('.form-save')[0]);
        $.ajax({
            url: "{{ route('store-customer') }}",
            type: 'POST',
            data: data,
            async: true,
            cache: false,
            contentType: false,
            processData: false
        }).done(function(data) {
            $('.form-save').validate(data, 'has-error');
            if (data.status == 'success') {
                toastr.success(data.message);
                $('#addCustomer').modal('hide'); // Show the modal
                $('.main-page').show();
                $('#datagrid').DataTable().ajax.reload();
                // $('#addPrinciple').fadeOut(function(){
                // $('#addPrinciple').empty();
                // $('.add-principle-page').fadeIn();
                // $('#datagrid').DataTable().ajax.reload();
                // });
            } else if (data.status == 'error') {
                $('.btn-submit');
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    delayIndicator: false,
                    icon: 'bx bx-x-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    sound: false,
                    msg: data.message
                });
                swal('Error :' + data.errMsg.errorInfo[0], data.errMsg.errorInfo[2], 'warning');
            } else {
                var n = 0;
                for (key in data) {
                    if (n == 0) {
                        var dt0 = key;
                    }
                    n++;
                }
                $('.btn-submit');
                Lobibox.notify('warning', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    delayIndicator: false,
                    icon: 'bx bx-error',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    sound: false,
                    msg: data.message
                });
            }
        }).fail(function() {
            $('.btn-submit');
            Lobibox.notify('warning', {
                title: 'Maaf!',
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                icon: 'bx bx-error',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                sound: false,
                msg: 'Terjadi Kesalahan, Silahkan Ulangi Kembali atau Hubungi Tim IT !!'
            });
        });
    });
</script>
