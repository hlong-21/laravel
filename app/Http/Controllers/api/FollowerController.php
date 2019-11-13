<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller; 
use App\Models\Follower; 
use Validator;

class FollowerController extends Controller 
{
    /** 
     * post api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function follow(Request $request) {
        $user = Auth::user(); 
        $input = $request->all();

        $follow = Follower::where('user_id', '=', $user->id)
            ->where('partner_id', '=', $input['partner_id'])
            ->get()->first();

        if (empty($follow)) {
            $follow = new Follower;
            $follow->partner_id = $input['partner_id'];
            $follow->user_id = $user->id;
            $follow->save();
        }

        return response()->success($follow); 
    }

    public function unfollow(Request $request) {
        $user = Auth::user(); 
        $input = $request->all();

        $follow = Follower::where('user_id', '=', $user->id)
            ->where('partner_id', '=', $input['partner_id'])
            ->delete();

        return response()->success([]);
    }
}