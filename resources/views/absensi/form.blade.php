<div class="modal fade" id="addAbsensi" aria-hidden="false" aria-modal="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">{{$data? "Edit Absensi" : "Tambah Absensi"}}</h3>
                    <p class="address-subtitle">Isi dengan lengkap form berikut ini</p>
                </div>
                <form class="row g-4 form-save" >
                    <input type="hidden" value="{{ $data ? $data->id_absensi : null }}" name="id">
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <select id="sales" name="sales_id" class="select2 form-select" data-allow-clear="true">
                                {{-- <option value="{{$data? $data->customer->id_customer :null}}">{{$data ? $data->customer->nama_customer : "Pilih"}}</option> --}}
                                @if (empty($data))
                                <option disabled selected>Pilih</option>
                                @endif
                                @foreach($sales as $item)
                                <option value="{{$item->id_sales}}"@if (!empty($data))
                                        @if ($data->sales->id_sales == $item->id_sales )
                                            selected
                                        @endif
                                @endif>{{$item->nama_sales}}</option>
                                @endforeach
                            </select>
                            <label for="nama_sales">Nama Sales *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="datetime-local" id="tanggal" name="tanggal"
                                value="{{ $data ? $data->tanggal->format('Y-m-d\TH:i') : null }}" class="form-control"
                                placeholder="Tanggal " />
                            <label for="tanggal">Tanggal *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <select id="status" name="status_kehadiran" class="select2 form-select"
                                data-allow-clear="true">
                                <option disabled selected>Pilih</option>
                                <option value="masuk"
                                {{ $data && $data->status_kehadiran == 'masuk' ? 'selected' : '' }}>Masuk
                                </option>
                                <option value="pulang"
                                        {{ $data && $data->status_kehadiran == 'pulang' ? 'selected' : '' }}>Pulang
                                </option>
                            </select>
                           
                            <label for="Status">Status Kehadiran *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="location_name" placeholder="Lokasi" required class="form-control" value="{{$data ? $data->location_name : null}}">
                            <label for="location_name">Nama Lokasi *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="latitude" placeholder="Latitude" required class="form-control" value="{{$data ? $data->latitude : null}}">
                            <label for="latitude">Latitude *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="longitude" placeholder="Longitude" required class="form-control"value="{{$data ? $data->longitude : null}}">
                            <label for="longtitude">Longtitude *</label>
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
    $(document).ready(function() {
    $('#sales').select2({
        dropdownParent: $('#addAbsensi')
    });
});
console.log($('#customer').val());
$('.btn-submit').click(function(e) {
        e.preventDefault();
        // $('.btn-submit').html('Please wait...').attr('disabled', true);
        $('.btn-submit');
        var data = new FormData($('.form-save')[0]);
        $.ajax({
            url: "{{ route('store-absensi') }}",
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
                $('#addAbsensi').modal('hide'); // Show the modal
                $('.main-page').show();
                $('#datagrid').DataTable().ajax.reload();
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

