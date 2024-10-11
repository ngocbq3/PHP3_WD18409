<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->latest('id')->paginate(10);
        return response()->json([
            'success' => true,
            'message' => 'Danh sách bài viết',
            'data' => $posts,
        ]);
    }

    public function show($id)
    {
        try {
            $post = Post::query()->findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Chi tiết bài viết',
                'data' => $post
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Không có bài viết phù hợp',
                'data' => null
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::query()->findOrFail($id);
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa dữ liệu thành công'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Xóa dữ liệu không thành công'
            ]);
        }
    }

    //Hàm upload ảnh
    public function uploadFile(Request $request, $filename)
    {
        if ($request->hasFile($filename)) {
            return $request->file($filename)->store('images');
        }
        return '';
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'min:3'],
            'image' => ['nullable', 'image', 'max: 2048'],
            'description' => ['required'],
            'content' => ['required'],
            'category_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi nhập liệu',
                'errors' => $validator->errors(),
            ]);
        }

        try {
            //Lấy đường dẫn ảnh, upload
            $data['image'] = $this->uploadFile($request, 'image');
            $post = Post::query()->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Thêm dữ liệu thành công',
                'data' => $post,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    //update
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'min:3'],
            'image' => ['nullable', 'image', 'max: 2048'],
            'description' => ['required'],
            'content' => ['required'],
            'category_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi nhập liệu',
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $post = Post::query()->findOrFail($id);
            //upload ảnh nếu có
            if ($request->hasFile('image')) {
                //xóa ảnh cũ
                if ($post->image) {
                    Storage::delete($post->image);
                }
                $data['image'] = $this->uploadFile($request, 'image');
            } else {
                $data['image'] = $post->image;
            }
            $post->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật dữ liệu thành công',
                'data' => $post
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
