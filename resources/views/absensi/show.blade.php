
<div class="card p-3" id="detailAbsensi" tabindex="-1"  aria-hidden="false" aria-modal="true">
  <div class="card-header flex text-center align-items-center justify-content-center mb-4">
    <h5 class="mb-0">Detail Absensi</h5>
  </div>
  <div class="card-body">
    <form class="form-save">

      <input type="hidden" value="{{ $data ? $data->id_absensi : null}}" name="id">
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
            <input type="datetime-local" id="tanggal" name="tanggal"
            value="{{ $data && $data->tanggal ? \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d\TH:i') : '' }}"
            class="form-control" placeholder="Tanggal " disabled />        
          <label for="tanggal">Tanggal *</label>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <select id="status" name="status_kehadiran" class="select2 form-select"
                                data-allow-clear="true" disabled>
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
            <input type="text" name="location_name" placeholder="Lokasi" required class="form-control" disabled value="{{$data?$data->location_name :null}}">
             <label for="location_name">Nama Lokasi *</label>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <input type="text" name="latitude" placeholder="Latitude" required class="form-control" disabled value="{{$data?$data->latitude :null}}">
                            <label for="latitude">Latitude *</label>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <input type="text" name="longitude" placeholder="Longtitude" required class="form-control" disabled value="{{$data?$data->longitude :null}}">
                            <label for="longitude">Longtitude *</label>
          </div>
        </div>
        <div class="col-12 mb-3">
          <div class="form-floating form-floating-outline">
            <div id="map" style="height: 400px;"></div>

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
    $('.add-absensi-page').fadeOut(function(){
      $('.add-absensi-page').empty();
      $('.main-page').fadeIn();
      // $('#datagrid').DataTable().ajax.reload();
    });
});

</script>

<script>
  var map = L.map('map').setView([0, 0], 2);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 18,
  }).addTo(map);


     
          
        L.marker([{{ $data->latitude }}, {{ $data->longitude }}])
            .addTo(map)
            .bindPopup("{{ $data->location_name }}");
    
</script>