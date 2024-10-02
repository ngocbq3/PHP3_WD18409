<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('test', function () {
//     return "Test URI website";
// });
// Route::get('/test-controller', [TestController::class, 'index']);
// //Truyền tham số vào đường dẫn
// Route::get('product/{id}', function ($id) {
//     return "Product Id: $id";
// });
// //Truy cập trực tiếp đến view
// Route::view('/welcome', 'welcome');
// //Truyền nhiều tham số vào đường dẫn
// Route::get('product/{id}/comment/{comment_id}', function ($id, $comment_id) {
//     return "Product ID: $id && Comment ID: $comment_id";
// });
// //Tham số truyền vào có thể rỗng
// Route::get('user/{name?}', function ($name = null) {
//     return "Tên user: $name";
// });
// //Chỉ định dữ liệu cho tham số
// Route::get('users/{fullname}', function ($fullname) {
//     return "<h1>Fullname: $fullname</h1>";
// })->where('fullname', '[A-Za-z]+');
// Route::get('users/{fullname}/{age}', function ($fullname, $age) {
//     return "<h1>Fullname: $fullname, có tuổi $age<h1>";
// })->where(['fullname' => '[A-Za-z]+', 'age' => '[0-9]+']);
// //Đặt tên cho đường dẫn
// Route::get('admin', function () {
//     return "ADMIN";
// })->name('admin');
// Route::view('menu', 'menu');

// Route::get('posts', function () {
//     //Lấy tất cả dữ liệu bảng posts
//     // $posts = DB::table('posts')->get();
//     //Lấy dữ liệu theo cột
//     $posts = DB::table('posts')
//         ->select('title', 'content')
//         ->get();


//     //Lấy dữ liệu có điều kiện =
//     $posts = DB::table('posts')
//         ->where('category_id', 1)
//         ->get();
//     //Lấy dữ liệu điều kiện >
//     $posts = DB::table('posts')
//         ->where('id', '>', 80)
//         ->get();
//     //Lấy dữ liệu theo điều LIKE
//     $posts = DB::table('posts')
//         ->where('title', 'LIKE', '%ipsum%')
//         ->get();

//     //Nối hai bảng posts và categories
//     $posts = DB::table('posts')
//         ->join('categories', 'posts.category_id', '=', 'categories.id')
//         ->get();

//     return $posts;
// });

// //Lấy ra 1 bản ghi
// Route::get('post/{id}', function ($id) {
//     $post = DB::table('posts')
//         ->where('id', $id)
//         ->first();

//     return $post;
// });

Route::get('/', [PostController::class, 'home'])->name('page.home');
Route::get('/category/{id}', [PostController::class, 'list'])->name('page.list');
Route::get('/post/{id}', [PostController::class, 'detail'])->name('page.detail');

Route::get('/test', [PostController::class, 'test']);

Route::get('/home', [PostController::class, 'index']);

//Admin
Route::prefix('admin')->group(function () {
    Route::get('posts', [AdminPostController::class, 'index'])->name('admin.posts.index');

    Route::get('/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');

    Route::post('/posts/create', [AdminPostController::class, 'store'])->name('admin.posts.store');

    Route::get('/posts/edit/{id}', [AdminPostController::class, 'edit'])->name('admin.posts.edit');

    Route::put('/posts/edit/{id}', [AdminPostController::class, 'update'])->name('admin.posts.update');

    Route::delete('/posts/delete/{id}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
});
