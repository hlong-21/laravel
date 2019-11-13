<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller; 
use App\Models\User; 
use App\Models\Follower; 
use Validator;

class UserController extends Controller 
{
    public $successStatus = 200;

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login() { 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) { 
            $user = Auth::user(); 
            $token =  $user->createToken('JSC1qrprqUihLCSTLPmfE96VxiTZWNnoc7ZqT3Mi')->accessToken; 
            return response()->success([
                'token' => $token,
                'name' => $user->name
            ]); 
        } else { 
            return response()->error(['error'=>'Unauthorised'], 401); 
        } 
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 

        $user = User::create($input); 
        $token =  $user->createToken('JSC1qrprqUihLCSTLPmfE96VxiTZWNnoc7ZqT3Mi')-> accessToken; 
        $success['name'] =  $user->name;

        return response()->success([
            'token' => $token,
            'name' => $user->name
        ]); 
    }
    
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function getUser() 
    { 
        $user = Auth::user(); 
        return response()->success($user); 
    } 
    
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function getUsers() 
    { 
        $user = Auth::user(); 

        $users = User::select(
            'users.id as id',
            'users.name as name',
            'users.email as email',
            'users.created_at as created_at',
            'followers.user_id as user_id'
        )
            ->leftJoin('followers', function ($join) {
                $join->on('followers.partner_id', '=', 'users.id')
                    ->whereNull('followers.deleted_at');
            })
            ->where('users.id', '<>', $user->id)
            ->whereNull('users.deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->success($users); 
    } 
}