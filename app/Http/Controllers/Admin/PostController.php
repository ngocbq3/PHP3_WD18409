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

        return redirect()->route('admin.posts.index')
            ->with('message', 'Tạo mới dữ liệu thành công');
    }

    //Hiển thị form edit post
    public function edit(Request $request, Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    //Hàm cập nhật dữ liệu
    public function update(Request $request, Post $post)
    {
        //Lấy dữ liệu từ form
        $data = $request->except('image');

        //If cập nhật ảnh
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images'); //Upload file
            //Xóa file cũ
            Storage::delete($post->image);
            //Cập nhật ảnh mới
            $data['image'] = $path;
        }

        //Cập nhật dữ liệu
        $post->update($data);

        return redirect()->route('admin.posts.index')->with('message', 'Cập nhật dữ liệu thành công');
    }

    //Xóa dữ liệu
    public function destroy(Post $post)
    {
        Storage::delete($post->image);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('Xóa dữ liệu thành công');
    }
}
