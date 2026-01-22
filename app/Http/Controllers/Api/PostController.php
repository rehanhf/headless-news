<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(Request $request)
    {
        #if user is searching, dont cache (dynamic)
        if ($request->has('search')) {
            $posts = Post::with(['author', 'category', 'tags'])
                ->whereFullText(['title', 'content'], $request->search)
                ->paginate(5);
            
            return PostResource::collection($posts);
        }

        #check if page number is in url (e.g. ?page=2)
        $page = $request->get('page', 1);

        #create a unique key for redis (e.g. 'posts_page_1')
        $cache_key = 'posts_page_' . $page;

        #remember logic: check redis -> if missing, run function & save -> return
        $posts = Cache::remember($cache_key, 60, function () {
            return Post::with(['author', 'category', 'tags'])
                ->latest()
                ->paginate(5);
        });

        return PostResource::collection($posts);
    }
}
