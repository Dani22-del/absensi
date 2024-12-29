<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Sales;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Validator, DB, Hash, Auth;
class ScheduleController extends Controller
{
    
    public function index(Request $request)
    {
    //  return   $data = Schedule::with('sales','customer')->get();
        // return view('schedule.main');
    // return    $data['data'] =  Schedule::with('sales','customer')->where('id_schedule',9)->first() ;
        if ($request->ajax()) {
            $data = Schedule::with('sales','customer')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                <i class="ri-more-2-line"></i>
            </button>
            <div class="dropdown-menu " data-popper-placement="bottom-end">
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_schedule. ')">
                    <i class="ri-pencil-line me-1"></i> Edit
                </a>
                 <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="detailSchedule(' . $row->id_schedule . ')">
                  <i class="ri-zoom-in-line"></i> Detail
              </a>
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_schedule. ')">
                    <i class="ri-delete-bin-7-line me-1"></i> Delete
                </a>
            </div>
        </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        

        return view('schedule.main')->with('data');
    }

    public function addSchedule(Request $request)
    {
        try {
            $data['data'] = $request->id ? Schedule::with('sales','customer')->where('id_schedule',$request->id)->first() : null;
            $data['customer'] = Customer::all();
            $data['sales'] = Sales::all();
            $content = view('schedule.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }
    public function detailSchedule(Request $request)
  {
    try {
      $data['customer'] = Customer::all();
      $data['sales'] = Sales::all();
      $data['data'] = $request->id ? Schedule::with('sales','customer')->where('id_schedule',$request->id)->first() : null;
      $content = view('schedule.show', $data)->render();
      return ['status' => 'success', 'content' => $content];
    } catch (\Exception $e) {
      return ['status' => 'success', 'content' => $e->getMessage()];
    }
  }
    public function store(Request $request)
    {
       
        $request->validate([
            'sales_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'tanggal_jadwal' => 'required|date',
            'description' => 'nullable|string',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048',
        ]);
        try {
            if (!empty($request->id)) {
                $data = Schedule::find($request->id);
            } else {
                $data = new Schedule();
            }
            $data->sales_id = $request->sales_id;
            $data->customer_id = $request->customer_id;
            $data->tanggal_jadwal = $request->tanggal_jadwal;
            $data->status = $request->top;
            $data->description = $request->description;
            if ($request->hasFile('photo_path')) {
                $file = $request->file('photo_path');
                if (!empty($data->photo_path) && file_exists(public_path($data->photo_path))) {
                    unlink(public_path($data->photo_path)); // Hapus file dari folder
                }
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = 'photos'; // Lokasi relatif dari public
                // Cek apakah nama file sudah ada di database
                // Memindahkan file ke folder public/uploads/photos
                $file->move(public_path($filePath), $filename);
            
                // Simpan path ke database
                $data->photo_path = $filePath . '/' . $filename;
            }
            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                if (!empty($data->file_path) && file_exists(public_path($data->file_path))) {
                    unlink(public_path($data->file_path));
                }
                $filename = time() . '_' . $file->getClientOriginalName();
                $tempatfile = 'files'; // Lokasi relatif dari public
                            // Memindahkan file ke folder public/uploads/photos
                $file->move(public_path($tempatfile), $filename);
            
                // Simpan path ke database
                $data->file_path = $tempatfile . '/' . $filename;
            }
            
           
            
            $data->save();
            if ($data) {
                if (!empty($request->id)) {
                    return ['code' => '200', 'status' => 'success', 'message' => 'Berhasil Edit Data'];
                } else {
                    return ['code' => '200', 'status' => 'success', 'message' => 'Berhasil Tambah Data'];
                }
            } else {
                return ['code' => '201', 'status' => 'error', 'message' => 'Error'];
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Terjadi Kesalahan di Sistem, Silahkan Hubungi Tim IT Anda!!',
                'errMsg' => $e->getMessage(),
            ]);
        }
    }



    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        try {
            $data = Schedule::find($request->id);

            if (!$data) {
                return response()->json(
                    [
                        'error' => 'Data not found',
                    ],
                    404
                );
            }

            
            // Menghapus file foto jika ada
        if (!empty($data->photo_path) && file_exists(public_path($data->photo_path))) {
            unlink(public_path($data->photo_path)); // Hapus file dari folder
        }
        if (!empty($data->file_path) && file_exists(public_path($data->file_path))) {
            unlink(public_path($data->file_path)); // Hapus file dari folder
        }
            $data->delete();

            return response()->json([
                'success' => 'Data Berhasil Dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => 'Terjadi kesalahan, silahkan coba lagi',
                ],
                500
            );
        }
    }
}

