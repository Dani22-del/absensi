<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;

class CustomerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Customer::all();
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
      $data = Customer::find($id);
  
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
        try {
            if (!empty($request->id)) {
                $data = Customer::find($request->id);
            } else {
                $data = new Customer();
            }
            $data->nama_customer = $request->nama_customer;
            $data->alamat_customer = $request->alamat_customer;
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
            $data = Customer::find($request->id);

            if (!$data) {
                return response()->json(
                    [
                        'error' => 'Data not found',
                    ],
                    404
                );
            }

            // Menghapus file foto jika ada
            // if ($data->foto && Storage::exists('public/' . $data->foto)) {
            //     Storage::delete('public/' . $data->foto);
            // }
            
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
