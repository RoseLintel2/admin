<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('foo',function(){
	return 'foo';
});

Route::any('index','IndexController@index');
Route::any('api','apiTestController@kk');
Route::get('kk', function () {
   "App\Http\Controllers\Kkk\kk";
});

Route::any('kep',function (){
	echo "kp";
})->name('Kkk_kk');

Route::any('Student','StudentController@index');

//月考抽奖
Route::any('yueks','YuekaoController@index');
//月考抽奖接口
Route::any('yueks/add','YuekaoController@add');
//中奖者名单
Route::any('yueks/list','YuekaoController@list');


// //学习类的路由组
Route::prefix('study')->group(function(){

	/*--------------------------------------[红包相关]-------------------------------------*/



	//红包首页路由
	Route::any('bonus/index','Study\BonusController@index');
	//红包添加路由
	Route::any('bonus/add','Study\BonusController@addBonus');
	//红包列表
	Route::any('bonus/list','Study\BonusController@getList');
	//获取红包的列表
	Route::any('get/bonus','Study\BonusController@getBonus');
	//人气王列表
	Route::any('bonus/flag','Study\BonusController@getMaxBonus');




	/*--------------------------------------[红包相关]-------------------------------------*/




	/*--------------------------------------[赌球相关]-------------------------------------*/

	//添加
	Route::any('guess/add','Study\GuessController@add');
	//执行添加
	Route::any('guess/doAdd','Study\GuessController@doAdd');
	//赌球列表
	Route::any('guess/list','Study\GuessController@list');
	//我要竞猜
	Route::any('guess/guess/{id?}','Study\GuessController@guess');
	//执行竞猜
	Route::any('guess/doguess','Study\GuessController@doGuess');
	//竞猜结果
	Route::any('guess/Result/{id?}','Study\GuessController@Result');

	/*--------------------------------------[赌球相关]-------------------------------------*/




	/*--------------------------------------[抽奖相关]-------------------------------------*/


	//抽奖首页
	Route::any('lottery/index','Study\LotteryController@index');
	//抽奖接口
	Route::any('lottery/add','Study\LotteryController@add');

	/*--------------------------------------[抽奖相关]-------------------------------------*/
});



//考试
Route::any('ks','KshbController@index');
//抢红包接口
Route::any('getBonus','KshbController@getBonus');
//发红包
Route::any('addBonus','KshbController@addBonus');
//红包列表
Route::any('list','KshbController@list');

//登录页面
Route::any('admin/login','Admin\LoginController@index');
//执行登录
Route::any('admin/doLogin','Admin\LoginController@doLogin');
//用户退出
Route::any('admin/logout','Admin\LoginController@logout');
//403页面
Route::get('403', function () {
   	return view('admin.403');
});

//管理后台RBAC功能的路由组
Route::middleware('admin_auth')->prefix('admin')->group(function(){
	

	

	
	//管理后台首页
	Route::any('home','Admin\HomeController@home')->name('admin.home');

	/*--------------------------------------[权限相关]-------------------------------------*/

	//权限列表
	Route::any('/permission/list','Admin\PermissionController@list')->name('admin.permission.list');

	//获取权限的数据
	Route::any('/get/permission/list/{fid}','Admin\PermissionController@getPermissionList')->name('admin.get.permission.list');

	//权限添加
	Route::any('/permission/create','Admin\PermissionController@create')->name('admin.permission.create');

	//执行权限添加
	Route::any('permissions/doCreate','Admin\PermissionController@doCreate')->name('admin.permission.doCreate');
	//删除权限操作
	Route::any('/permissions/del/{id}','Admin\PermissionController@del')->name('admin.permission.del');

	/*--------------------------------------[权限相关]-------------------------------------*/



	/*--------------------------------------[用户相关]-------------------------------------*/

	//用户添加页面
	Route::get('/user/add','Admin\AdminUsersController@create')->name('admin.user.add');

	//执行用户添加
	Route::any('/user/store','Admin\AdminUsersController@store')->name('admin.user.store');

	//用户列表页面
	Route::any('/user/list','Admin\AdminUsersController@list')->name('admin.user.list');

	//用户删除操作
	Route::any('/user/del/{id}','Admin\AdminUsersController@delUser')->name('admin.user.del');

	//用户修改页面
	Route::any('/user/edit/{id}','Admin\AdminUsersController@edit')->name('admin.user.edit');

	//执行用户修改
	Route::any('/user/doEdit','Admin\AdminUsersController@doEdit')->name('admin.user.doEdit');


	/*--------------------------------------[用户相关]-------------------------------------*/



	/*--------------------------------------[角色相关]-------------------------------------*/

	//角色列表
	Route::any('/role/list','Admin\RoleController@list')->name('admin.role.list');

	//角色删除
	Route::any('/role/del/{id}','Admin\RoleController@delRole')->name('admin.role.del');

	//角色添加
	Route::any('/role/create','Admin\RoleController@create')->name('admin.role.create');

	//角色执行添加
	Route::any('/role/store','Admin\RoleController@store')->name('admin.role.store');

	//角色修改
	Route::any('/role/edit/{id}','Admin\RoleController@edit')->name('admin.role.edit');

	//角色执行修改
	Route::any('/role/doEdit','Admin\RoleController@doEdit')->name('admin.role.doEdit');

	//角色权限修改
	Route::any('/role/permission/{id}','Admin\RoleController@rolePermission')->name('admin.role.permission');

	//角色权限执行修改
	Route::any('/role/save/permission','Admin\RoleController@saveRolePermission')->name('admin.role.permission.save');

	/*--------------------------------------[角色相关]-------------------------------------*/


	/*--------------------------------------[小说相关]-------------------------------------*/

	//作者列表
	Route::any('author/list','Admin\AuthorController@list')->name('admin.author.list');
	//作者添加
	Route::any('author/create','Admin\AuthorController@create')->name('admin.author.create');
	//执行作者添加
	Route::any('author/store','Admin\AuthorController@store')->name('admin.author.store');
	//作者删除
	Route::any('author/del/{id}','Admin\AuthorController@del')->name('admin.author.del');


	//小说类型列表
	Route::any('category/list','Admin\categoryController@list')->name('admin.category.list');
	//小说类型添加
	Route::any('category/create','Admin\categoryController@create')->name('admin.category.create');
	//小说类型执行添加
	Route::any('category/store','Admin\categoryController@store')->name('admin.category.store');
	//小说类型删除
	Route::any('category/del/{id}','Admin\categoryController@del')->name('admin.category.del');




     //小说添加
     Route::get('novel/create','Admin\NovelController@create')->name('admin.novel.create');
     //执行小说添加
     Route::post('novel/store','Admin\NovelController@store')->name('admin.novel.store');
     //小说列表
     Route::get('novel/list','Admin\NovelController@list')->name('admin.novel.list');
     //小说编辑
     Route::get('nove/edit/{id}','Admin\NovelController@edit')->name('admin.novel.edit');
     //执行小说编辑
     Route::post('nove/doEdit','Admin\NovelController@doEdit')->name('admin.novel.doEdit');
     //小说的删除
     Route::get('novel/del/{id}','Admin\NovelController@del')->name('admin.novel.del');


     //小说章节添加
     Route::get('chapter/add/{novel_id?}','Admin\ChapterController@create')->name('admin.chapter.create');
     //保存小说章节
     Route::post('chapter/store','Admin\ChapterController@store')->name('admin.chapter.store');
     //小说章节列表
     Route::get('chapter/list/{novel_id?}','Admin\ChapterController@list')->name('admin.chapter.list');
     //小说章节删除
     Route::get('chapter/del/{$id}','Admin\ChapterController@del')->name('admin.chapter.del');
     //章节编辑
     Route::get('chapter/edit/{id}','Admin\ChapterController@edit')->name('admin.chapter.edit');
     //执行章节编辑
     Route::post('chapter/doEdit','Admin\ChapterController@doEdit')->name('admin.chapter.doEdit');




      //小说评论列表页面
     Route::get('novel/comment/list','Admin\CommentController@list')->name('admin.novel.comment.list');
     //小说数据
     Route::get('novel/comment/data','Admin\CommentController@getComment')->name('admin.novel.comment.data');
     //小说评论审核
     Route::get('novel/comment/check/{id}','Admin\CommentController@check')->name('admin.novel.comment.check');
     //小说评论删除
     Route::get('novel/comment/del/{id}','Admin\CommentController@del')->name('admin.novel.comment.del');


     

	/*--------------------------------------[小说相关]-------------------------------------*/

});