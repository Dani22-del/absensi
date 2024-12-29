
<div class="card p-3" id="detailSchedule" tabindex="-1"  aria-hidden="false" aria-modal="true">
  <div class="card-header flex text-center align-items-center justify-content-center mb-4">
    <h5 class="mb-0">Detail Schedule</h5>
  </div>
  <div class="card-body">
    <form class="form-save">
      {{-- <div class="col-12 mb-3">
        <img src="{{ asset( $data->photo_path) }}" style="width: 100%; height:500px; object-fit: cover; border-radius:5px">
        
      </div> --}}
      @if (!empty($data))
    <div class="col-12 mb-3">
        @if (!empty($data->photo_path))
            @php
                $photoExtension = pathinfo($data->photo_path, PATHINFO_EXTENSION);
            @endphp
            @if (in_array($photoExtension, ['jpg', 'jpeg', 'png', 'gif']))
                <!-- Menampilkan gambar -->
                <img src="{{ asset($data->photo_path) }}" style="width: 100%; height: 500px; object-fit: cover; border-radius: 5px;">
            @else
                <!-- Pesan jika format gambar tidak valid -->
                <p>Format gambar tidak valid. <a href="{{ asset($data->photo_path) }}" target="_blank">Download file</a></p>
            @endif
        @endif

        @if (!empty($data->file_path))
            @php
                $fileExtension = pathinfo($data->file_path, PATHINFO_EXTENSION);
            @endphp
            @if ($fileExtension === 'pdf')
                <!-- Menampilkan PDF -->
                <iframe src="{{ asset($data->file_path) }}" style="width: 100%; height: 500px;" frameborder="0"></iframe>
            @elseif (in_array($fileExtension, ['doc', 'docx', 'txt']))
                <!-- Link untuk file dokumen lainnya -->
                <a href="{{ asset($data->file_path) }}" target="_blank" class="btn btn-link">
                    Lihat Dokumen: {{ basename($data->file_path) }}
                </a>
            @else
                <!-- Pesan untuk format file yang tidak didukung -->
                <p>Format file tidak didukung untuk pratinjau. <a href="{{ asset($data->file_path) }}" target="_blank">Download file</a></p>
            @endif
        @endif
    </div>
@endif

      <input type="hidden" value="{{ $data ? $data->id_schedule : null}}" name="id">
      <div class="row">
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <select id="sales" name="sales_id" class="select2 form-select" data-allow-clear="true" disabled>
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
        <div class="col-6 ">
          <div class="form-floating form-floating-outline">
                <input type="date" id="tanggal_jadwal" name="tanggal_jadwal"
                value="{{ $data ? $data->tanggal_jadwal : null }}" class="form-control"
                placeholder="Tanggal Jadwal" disabled />
            <label for="tanggal jadwal">Tanggal Jadwal *</label>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <select id="customer" name="customer_id" class="select2 form-select" data-allow-clear="true" disabled>
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
            data-allow-clear="true" disabled>
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
        <div class="col-12 mb-3">
          <div class="form-floating form-floating-outline">
            <input type="text" id="keterangan" name="keterangan"value="{{ $data ? $data->description : null}}" class="form-control" placeholder="Placeholder"disabled/>
            <label for="keterangan">Keterangan *</label>
            
          </div>
        </div>
      </div>
    </form>
    <div class="col-12 text-end">
      <button type="reset" class="btn btn-outline-secondary btn-cancel" ><i class="ri-arrow-left-s-line me-1"></i> Cancel</button>
    </div>
  </div>
</div>

<script>
 
   $('.btn-cancel').click(function(e){
    e.preventDefault();
    $('.add-schedule-page').fadeOut(function(){
      $('.add-schedule-page').empty();
      $('.main-page').fadeIn();
      // $('#datagrid').DataTable().ajax.reload();
    });
});

</script>

