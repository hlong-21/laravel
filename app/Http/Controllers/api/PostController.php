<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller; 
use App\Models\Post; 
use App\Models\Follower; 
use Validator;

class PostController extends Controller 
{
    /** 
     * post api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function save(Request $request) { 
        $input = $request->all();
        $user = Auth::user(); 

        $posts = new Post;
        $posts->content = $input['content'];
        $posts->user_id = $user->id;
        $posts->save();

        return response()->success($posts); 
    }

    public function list(Request $request) {
        $user = Auth::user();
        $userIds = Follower::where('user_id', '=', $user->id)->pluck('partner_id')->toArray();

        array_push($userIds, $user->id);


        $posts = Post::select(
                'posts.id as id',
                'users.name as name',
                'users.email as email',
                'posts.content as content',
                'posts.user_id as user_id',
                'posts.created_at as date'
            )
            ->whereIn('user_id', $userIds)
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->orderBy('date', 'desc')
            ->get();

        foreach ($posts as $key => $value) {
            $value->is_delete = $value->user_id == $user->id;
        }

        return response()->success($posts);
    }

    public function delete($id) {
        Post::where('id', '=', $id)->delete();

        return response()->success([]);
    }
}