<?php
namespace App\Http\Controllers;
use App\Http\Requests\SignupRequest;
use App\User;
use JWTAuth;
use Illuminate\Http\Request;
// use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','signup']]);
    }


    
    
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse());

     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if ($token = JWTAuth::attempt($credentials)) {
            return $this->respondWithToken($token);
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }


    // function signup

    public function signup(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->password = Hash::make($request->get('password'));
        $user->email = $request->email;
        $user->save();


        return $this->login($request);
         
    }

    
    
    
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()->name
         ]);
    }
    
}
