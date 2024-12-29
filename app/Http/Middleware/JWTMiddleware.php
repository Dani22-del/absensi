<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredExwception;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token    = $request->header('x-token');
		$username = $request->header('x-username');

		if(!$token || !$username){ // unauthorized response if token not there
			return response()->json([
				'status'   => false,
				'metaData' => [
					'code'    => 401,
					'message' => 'Token and username is required',
				],
			],401);
		}

		try{
			$keyBaru = 'e19c4ea9223aa246619f6aab0081c112f4aeb3c6674137c16413e5ea0c145405ffbf5d12d806cc8b529e33dd8a6a05bdccaa5fd4d257a11a5581cb7d0858b3be';

			$credentials = JWT::decode($token, new Key($keyBaru, 'HS256'));
		// 	\Log::info('Decoded UID:', ['uid' => $credentials->uid]);
		// 	\Log::info('Header Username:', ['username' => $username]);
		// 	\Log::info('Decoded Token:', ['token_payload' => (array) $credentials]);
		// 	\Log::info('Received Token:', ['token' => $token]);
        // \Log::info('Decoded UID:', ['uid' => $credentials->uid]);
        // \Log::info('Header Username:', ['username' => $username]);
        // \Log::info('Decoded Credentials:', (array) $credentials);
		// 		\Log::info('Decoded UID Type:', ['uid_type' => gettype($credentials->uid)]);
		// 		\Log::info('Header Username Type:', ['username_type' => gettype($username)]);
				
				$user = User::where('name',$username)->first();
			
        if (!$user) {
					return response()->json([
							'status'   => false,
							'metaData' => [
									'code'    => 404,
									'message' => "User  not found: $username",
							],
					], 404);
			}

			if ($credentials->uid !== $user->id) {
				return response()->json([
					'status'   => false,
					'metaData' => [
						'code'    => 401,
						'message' => "Invalid token for username: $username",
					],
				],401);
			}
		}catch(ExpiredException $e){
			return response()->json([
				'status'   => false,
				'metaData' => [
					'message' => 'Token Expired',
					'code'    => 201,
				],
			],400);
		}catch(Exception $e){
			Log::error($e->getMessage());
			return response()->json([
				'status'   => false,
				'metaData' => [
					'code'    => 400,
					'message' => 'Authentication failed',
				],
			],400);
		}

		return $next($request);
    }
}
