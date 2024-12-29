<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Sales;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Validator, DB, Hash, Auth;
use Carbon\Carbon;
class AbsensiController extends Controller
{
    
    public function index(Request $request)
    {
        // $data = Absensi::with('sales')->get();
        if ($request->ajax()) {
            $data = Absensi::with('sales')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                <i class="ri-more-2-line"></i>
            </button>
            <div class="dropdown-menu " data-popper-placement="bottom-end">
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_absensi. ')">
                    <i class="ri-pencil-line me-1"></i> Edit
                </a>
                 <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="detailAbsensi(' . $row->id_absensi . ')">
                  <i class="ri-zoom-in-line"></i> Detail
              </a>
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_absensi. ')">
                    <i class="ri-delete-bin-7-line me-1"></i> Delete
                </a>
            </div>
        </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        

        return view('absensi.main')->with('data');
        // return view('absensi.main', compact('data'));
    }

    public function addAbsensi(Request $request)
    {
        try {
            $data['data'] = $request->id ? Absensi::with('sales')->where('id_absensi',$request->id)->first() : null;
             // Konversi tanggal ke Carbon jika ada data
            if ($data['data'] && $data['data']->tanggal) {
                $data['data']->tanggal = Carbon::parse($data['data']->tanggal);
            }
            $data['sales'] = Sales::all();
            $content = view('absensi.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }
    public function detailAbsensi(Request $request)
    {
      try {
        $data['sales'] = Sales::all();
        $data['data'] = $request->id ? Absensi::with('sales')->where('id_absensi',$request->id)->first() : null;
        $content = view('absensi.show', $data)->render();
        return ['status' => 'success', 'content' => $content];
      } catch (\Exception $e) {
        return ['status' => 'success', 'content' => $e->getMessage()];
      }
    }
    public function store(Request $request)
    {
       
        try {
            if (!empty($request->id)) {
                $data = Absensi::find($request->id);
            } else {
                $data = new Absensi();
            }
            $data->sales_id = $request->sales_id;
            $data->tanggal = $request->tanggal;
            $data->status_kehadiran = $request->status_kehadiran;
            $data->latitude=$request->latitude;
            $data->longitude=$request->longitude;
            $data->location_name=$request->location_name;
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
            $data = Absensi::find($request->id);

            if (!$data) {
                return response()->json(
                    [
                        'error' => 'Data not found',
                    ],
                    404
                );
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

