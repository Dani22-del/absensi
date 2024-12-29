<div class="modal fade" id="addSchedule" aria-hidden="false" aria-modal="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">{{$data? "Edit Schedule" : "Tambah Schedule"}}</h3>
                    <p class="address-subtitle">Isi dengan lengkap form berikut ini</p>
                </div>
                <form class="row g-4 form-save"  >
                    <input type="hidden" value="{{ $data ? $data->id_schedule : null }}" name="id">
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
                            <input type="date" id="tanggal_jadwal" name="tanggal_jadwal"
                                value="{{ $data ? $data->tanggal_jadwal : null }}" class="form-control"
                                placeholder="Tanggal Jadwal" />
                            <label for="tanggal jadwal">Tanggal Jadwal *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <select id="customer" name="customer_id" class="select2 form-select" data-allow-clear="true">
                                {{-- <option value="{{$data? $data->customer->id_customer :null}}">{{$data ? $data->customer->nama_customer : "Pilih"}}</option> --}}
                                @if (empty($data))
                                <option disabled selected>Pilih</option>
                                @endif
                                @foreach($customer as $item)
                                
                                <option value="{{$item->id_customer}}"@if (!empty($data))
                                        @if ($data->customer->id_customer == $item->id_customer )
                                            selected
                                        @endif
                                @endif>{{$item->nama_customer}}</option>
                                @endforeach
                            </select>
                            <label for="Nama Customer">Nama Customer *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <select id="top" name="top" class="select2 form-select"
                                data-allow-clear="true">
                                <option disabled selected>Pilih</option>
                                <option value="hadir"
                                {{ $data && $data->status == 'hadir' ? 'selected' : '' }}>Hadir
                                </option>
                                <option value="reschedule"
                                        {{ $data && $data->status == 'reschedule' ? 'selected' : '' }}>Reschedule
                                </option>
                                <option value="batal"
                                        {{ $data && $data->status == 'batal' ? 'selected' : '' }}>Batal
                                </option>
                            </select>
                           
                            <label for="Status">Status *</label>
                        </div>
                    </div>
                    <div class="col-6 mb-3 ">
                        <div class="form-floating form-floating-outline">
                          <input type="file" id="foto_produk"  name="photo_path" class="form-control" placeholder="Placeholder" />
                          <label for="foto_produk">Foto Produk *</label>
                          @if (!empty($data) && $data->photo_path)
                                <small class="text-muted">File saat ini: {{ basename($data->photo_path) }}</small>
                                <div class="mt-2">
                                    <img src="{{ asset($data->photo_path) }}" alt="Foto Produk" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                           @endif
                        </div>
                    </div>
                    <div class="col-6 mb-3 ">
                        <div class="form-floating form-floating-outline">
                          <input type="file" id="file_path"  name="file_path" class="form-control" placeholder="Placeholder" />
                          <label for="foto_produk">File *</label>
                            @if (!empty($data) && $data->file_path)
                            <small class="text-muted">File saat ini: {{ basename($data->file_path) }}</small>
                            <div class="mt-2">
                                <a href="{{ asset($data->file_path) }}" target="_blank" class="btn btn-link">
                                    Lihat Dokumen
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                      <div class="col-12 mb-3">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Hasil Laporan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" value="{{ $data ? $data->description : null}}" rows="6">{{ $data ? $data->description : null}}</textarea>
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
    $('#customer').select2({
        dropdownParent: $('#addSchedule')
    });
    $('#sales').select2({
        dropdownParent: $('#addSchedule')
    });
});
console.log($('#customer').val());
$('.btn-submit').click(function(e) {
        e.preventDefault();
        // $('.btn-submit').html('Please wait...').attr('disabled', true);
        $('.btn-submit');
        var data = new FormData($('.form-save')[0]);
        $.ajax({
            url: "{{ route('store-schedule') }}",
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
                $('#addSchedule').modal('hide'); // Show the modal
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

