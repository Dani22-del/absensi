<?php

namespace App\Http\Controllers\Api;

use App\Models\Schedule;
use App\Models\Sales;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class ScheduleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Schedule::with('sales','customer')->get();
            return response()->json([
                'metaData' => [
                    'status' => 200,
                    'success' => true,
                    'message' => 'Data fetched successfully'
                ],
                'response' => [
                    'data' => $data
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'metaData' => [
                    'status' => 500,
                    'success' => false,
                    'message' => 'Failed to fetch data',
                    'error' => $e->getMessage()
                ],
                'response' => [
                    'data' => null
                ]
            ], 500);
          }
    }
    public function findOne($id)
    {
      $data = Schedule::with('sales','customer')->where('id_schedule',$id)->first();
  
      if(!$data){
        return response()->json([
          'metaData' => [
            'status' => 404,
            'success' => false,
            'message' => 'Data not found'
          ],
          'response' => [
            'data' => null
          ]
        ], 404);
      }
  
      return response()->json([
        'metaData' => [
          'status' => 200,
          'success' => true,
          'message' => 'Data fetched successfully'
        ],
        'response' => [
          'data' => $data
        ]
      ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
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
