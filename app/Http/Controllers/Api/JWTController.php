<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class JWTController extends Controller
{
    public function auth(Request $request){
		
		$username = $request->header('x-username');
		$password = $request->header('x-password');
		 $user = User::where('name',$username)->first();
		//  \Log::info('User Information:', ['user' => $user->id]);

		//  if (self::$username === $username && self::$password === $password)
		if ($user && Hash::check($password, $user->password)) {
			// $key = config('jwt.secret');
			$key = 'e19c4ea9223aa246619f6aab0081c112f4aeb3c6674137c16413e5ea0c145405ffbf5d12d806cc8b529e33dd8a6a05bdccaa5fd4d257a11a5581cb7d0858b3be';

			$payload = [
				'iss' => "JWT", // Issuer of the token
				'uid' => $user->id, 
				'iat' => time(),
				// 'exp' => time() + (20*3), // detik*menit
				'exp' => time() + (60*60*2), // detik*menit
			];
	
			$timeCur = date('d-m-Y H:i:s',$payload['exp']);
			$start   = strtotime('now');
			$end     = strtotime($timeCur);
			$diff    = $end - $start; // total detik
			$hours   = floor($diff / (60*60) ); // hitung total jam
			$minutes = floor( ($diff-$hours*(60*60)) / 60); // hitung menit(reset perJam)

			return [
				'response' => [
					'token'=> JWT::encode($payload, $key, 'HS256'),
					'expiration' => [
						'seconds' => $diff,
						'minutes' => $minutes,
					],
					'data' => $user,

				],
				'metadata' => ['message' => "Ok", 'code' => 200]
			];
		}

		return [
			'metadata' => [
				'message' => "Username atau Password Tidak Sesuai",
				'code' => 401
			]
		];
	}
}
