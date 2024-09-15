<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('test', function () {
    return "Test URI website";
});
Route::get('/test-controller', [TestController::class, 'index']);
//Truyền tham số vào đường dẫn
Route::get('product/{id}', function ($id) {
    return "Product Id: $id";
});
//Truy cập trực tiếp đến view
Route::view('/welcome', 'welcome');
//Truyền nhiều tham số vào đường dẫn
Route::get('product/{id}/comment/{comment_id}', function ($id, $comment_id) {
    return "Product ID: $id && Comment ID: $comment_id";
});
//Tham số truyền vào có thể rỗng
Route::get('user/{name?}', function ($name = null) {
    return "Tên user: $name";
});
//Chỉ định dữ liệu cho tham số
Route::get('users/{fullname}', function ($fullname) {
    return "<h1>Fullname: $fullname</h1>";
})->where('fullname', '[A-Za-z]+');
Route::get('users/{fullname}/{age}', function ($fullname, $age) {
    return "<h1>Fullname: $fullname, có tuổi $age<h1>";
})->where(['fullname' => '[A-Za-z]+', 'age' => '[0-9]+']);
//Đặt tên cho đường dẫn
Route::get('admin', function () {
    return "ADMIN";
})->name('admin');
Route::view('menu', 'menu');

Route::get('posts', function () {
    //Lấy tất cả dữ liệu bảng posts
    // $posts = DB::table('posts')->get();
    //Lấy dữ liệu theo cột
    $posts = DB::table('posts')
        ->select('title', 'content')
        ->get();
    return $posts;
});
