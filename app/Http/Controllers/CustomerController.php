<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Validator, DB, Hash, Auth;
class CustomerController extends Controller
{
    
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Customer::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                <i class="ri-more-2-line"></i>
            </button>
            <div class="dropdown-menu " data-popper-placement="bottom-end">
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_customer. ')">
                    <i class="ri-pencil-line me-1"></i> Edit
                </a>
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_customer. ')">
                    <i class="ri-delete-bin-7-line me-1"></i> Delete
                </a>
            </div>
        </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        

        return view('customer.main')->with('data');
    }

    public function addCustomer(Request $request)
    {
        try {
            $data['data'] = $request->id ? Customer::find($request->id) : null;
            $content = view('customer.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }

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

