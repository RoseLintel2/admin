<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*************************微信小程序接口*******************************/

//首页banner图
Route::any('home/bList','Api\HomeController@bLists');

//首页最新小说
Route::any('home/nList','Api\HomeController@nLists');

//首页排行
Route::any('home/cList','Api\HomeController@cLists');


//获取小说分类
Route::any('category/getCategory','Api\CategoryController@getCategory');
//获取分类小说列表
Route::any('category/novel','Api\CategoryController@getNovel');



//获取小说搜索列表
Route::any('search/novelName','Api\SearchController@getNovelByName');


//获取小说书库列表
Route::any('novel/bookList','Api\NovelController@bookList');

//获取小说阅读榜单
Route::any('read/rank','Api\NovelController@bookRank');

//获取小说详情
Route::any('novel/detail/{id}','Api\NovelController@detail');


//获取小说添加评论
Route::any('comment/add','Api\CommentController@add');