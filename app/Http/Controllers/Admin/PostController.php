<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->latest('id')
            ->paginate(8);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->file('image')->getClientOriginalName());
        $data = $request->except('image');

        //Xử lý ảnh
        $path = "";
        if ($request->hasFile('image')) {
            //upload ảnh            
            $path = $request->file('image')->store('images');
        }
        $data['image'] = $path;

        //Insert dữ liệu
        Post::query()->create($data);

        return redirect()->route('admin.posts.index');
    }
}
