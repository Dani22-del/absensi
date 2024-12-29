<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;


class Jwt1Controller extends Controller
{

	public function test(Request $request){
      return response()->json([
        'status' => true,
        'message' => 'Ini adalah respons sederhana dari fungsi test.',
        'data' => [
            'info' => 'Anda telah berhasil mengakses endpoint test.',
        ],
        'metadata' => [
            'code' => 200,
        ]
    ]);
	}
//     public function test(Request $request)
// {
//     \Log::info('Headers:', $request->headers->all());

//     $username = $request->header('x-username');
//     $token = $request->header('x-token');
//     $key = '06bce33b1514bbb6fc747d4f83abc575d3b1ca0303046b20369f05eddff03baf';

//     try {
//         // Decode token
//         $decoded = JWT::decode($token, new \Firebase\JWT\Key($key, 'HS256'));

//         // Validasi username dengan UID dari token
//         $user = User::find($decoded->uid);

//         if (!$user || $user->name !== $username) {
//             return response()->json([
//                 'status' => false,
//                 'metaData' => [
//                     'code' => 401,
//                     'message' => "Invalid token for username: $username",
//                 ],
//             ]);
//         }

//         // Jika valid
//         return response()->json([
//             'status' => true,
//             'message' => 'Token valid.',
//             'data' => $user,
//             'metadata' => [
//                 'code' => 200,
//             ],
//         ]);

//     } catch (\Exception $e) {
//         // Jika terjadi error
//         return response()->json([
//             'status' => false,
//             'metaData' => [
//                 'code' => 401,
//                 'message' => 'Token invalid: ' . $e->getMessage(),
//             ],
//         ]);
//     }
// }

}
