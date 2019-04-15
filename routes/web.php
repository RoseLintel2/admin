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

	/*--------------------------------------[商品品牌相关]-------------------------------------*/

	//商品品牌列表
	Route::any('brand/list','Admin\BrandController@list')->name('admin.brand.list');

	//商品品牌列表
	Route::any('brand/doList','Admin\BrandController@doList')->name('admin.brand.doList');

	//商品品牌添加页面
	Route::any('brand/add','Admin\BrandController@add')->name('admin.brand.add');
	//商品品牌执行添加
	Route::any('brand/doAdd','Admin\BrandController@doAdd')->name('admin.brand.doAdd');

	//商品品牌删除
	Route::any('brand/del/{id}','Admin\BrandController@del')->name('admin.brand.del');

	//商品品牌修改页面
	Route::any('brand/edit/{id}','Admin\BrandController@edit')->name('admin.brand.edit');
	//商品品牌执行修改
	Route::any('brand/doEdit','Admin\BrandController@doEdit')->name('admin.brand.doEdit');
	//修改品牌的属性值
	Route::post('brand/change/attr','Admin\BrandController@changeAttr')->name('admin.brand.change.attr');

    /*--------------------------------------[商品品牌相关]-------------------------------------*/
    

    /*--------------------------------------[商品品牌相关]-------------------------------------*/

    //商品分类列表页面
    Route::get('category2/list', 'Admin\Category2Controller@list')->name('admin.category2.list');

    //获取商品接口分类的数据
    Route::get('category2/get/data/{fid?}','Admin\Category2Controller@getListDate')->name('admin.category2.get.data');

    //商品添加页面
    Route::get('category2/add','Admin\Category2Controller@add')->name('admin.category2.add');

    //商品执行添加操作
    Route::post('category2/doAdd','Admin\Category2Controller@doAdd')->name('admin.category2.doAdd');

    //商品编辑页面
    Route::get('category2/edit/{id}','Admin\Category2Controller@edit')->name('admin.category2.edit');

    //商品执行编辑操作
    Route::post('category2/doEdit','Admin\Category2Controller@doEdit')->name('admin.category2.doEdit');
    
    //商品执行删除操作
    Route::get('category2/del/{id}','Admin\Category2Controller@del')->name('admin.category2.del');

    /*--------------------------------------[商品品牌相关]-------------------------------------*/



    /*--------------------------------------[商品文章分类相关]-------------------------------------*/

    //商品文章列表页面
    Route::get('article/category/list', 'Admin\ArticleCategoryController@list')->name('admin.article.category.list');

    //商品文章添加页面
    Route::get('article/category/add', 'Admin\ArticleCategoryController@add')->name('admin.article.category.add');

    //商品文章执行添加
    Route::post('article/category/doAdd', 'Admin\ArticleCategoryController@doAdd')->name('admin.article.category.doAdd');

    //商品文章修改页面
    Route::get('article/category/edit/{id}', 'Admin\ArticleCategoryController@edit')->name('admin.article.category.edit');

    //商品文章执行修改
    Route::post('article/category/doEdit', 'Admin\ArticleCategoryController@doEdit')->name('admin.article.category.doEdit');

    //商品文章删除
    Route::get('article/category/del/{id}', 'Admin\ArticleCategoryController@del')->name('admin.article.category.del');


    /*--------------------------------------[商品文章分类相关]-------------------------------------*/




    /*--------------------------------------[商品文章相关]-------------------------------------*/

    //商品文章列表页面
    Route::get('article/list', 'Admin\ArticleController@list')->name('admin.article.list');

    //商品文章添加页面
    Route::get('article/add', 'Admin\ArticleController@add')->name('admin.article.add');

    //商品文章执行添加
    Route::post('article/doAdd', 'Admin\ArticleController@doAdd')->name('admin.article.doAdd');

    //商品文章修改页面
    Route::get('article/edit/{id}', 'Admin\ArticleController@edit')->name('admin.article.edit');

    //商品文章执行修改
    Route::post('article/doEdit', 'Admin\ArticleController@doEdit')->name('admin.article.doEdit');

    //商品文章删除
    Route::get('article/del/{id}', 'Admin\ArticleController@del')->name('admin.article.del');



    /*--------------------------------------[商品文章相关]-------------------------------------*/

    /*--------------------------------------[广告位相关]-------------------------------------*/


    //广告位列表页面
    Route::get('position/list', 'Admin\AdPositionController@list')->name('admin.position.list');

    //广告位添加页面
    Route::get('position/add', 'Admin\AdPositionController@add')->name('admin.position.add');

    //广告位执行添加
    Route::post('position/doAdd', 'Admin\AdPositionController@doAdd')->name('admin.position.doAdd');

    //广告位修改页面
    Route::get('position/edit/{id}', 'Admin\AdPositionController@edit')->name('admin.position.edit');

    //广告位执行修改
    Route::post('position/doEdit', 'Admin\AdPositionController@doEdit')->name('admin.position.doEdit');

    //广告位删除
    Route::get('position/del/{id}', 'Admin\AdPositionController@del')->name('admin.position.del');
    

    /*--------------------------------------[广告位相关]-------------------------------------*/


    /*--------------------------------------[广告相关]---------------------------------------*/

    //广告列表页面
    Route::get('ad/list', 'Admin\AdController@list')->name('admin.ad.list');

    //广告添加页面
    Route::get('ad/add', 'Admin\AdController@add')->name('admin.ad.add');

    //广告执行添加
    Route::post('ad/doAdd', 'Admin\AdController@doAdd')->name('admin.ad.doAdd');

    //广告修改页面
    Route::get('ad/edit/{id}', 'Admin\AdController@edit')->name('admin.ad.edit');

    //广告执行修改
    Route::post('ad/doEdit', 'Admin\AdController@doEdit')->name('admin.ad.doEdit');

    //广告删除
    Route::get('ad/del/{id}', 'Admin\AdController@del')->name('admin.ad.del');



    /*--------------------------------------[广告相关]--------------------------------------*/

    /*--------------------------------------[商品属性列表]--------------------------------------*/

    //商品属性列表页面
    Route::get('goods/type/list', 'Admin\goodsTypeController@list')->name('admin.goods.type.list');

    //商品属性添加页面
    Route::get('goods/type/add', 'Admin\goodsTypeController@add')->name('admin.goods.type.add');

    //商品属性执行添加
    Route::post('goods/type/doAdd', 'Admin\goodsTypeController@doAdd')->name('admin.goods.type.doAdd');

    //商品属性修改页面
    Route::get('goods/type/edit/{id}', 'Admin\goodsTypeController@edit')->name('admin.goods.type.edit');

    //商品属性执行修改
    Route::post('goods/type/doEdit', 'Admin\goodsTypeController@doEdit')->name('admin.goods.type.doEdit');

    //商品属性删除
    Route::get('goods/type/del/{id}', 'Admin\goodsTypeController@del')->name('admin.goods.type.del');


    /*--------------------------------------[商品属性列表]--------------------------------------*/


    /*--------------------------------------[商品类型属性列表]--------------------------------------*/

     //商品类型属性列表页面
    Route::get('goods/attr/list/{id}', 'Admin\goodsAttrController@list')->name('admin.goods.attr.list');

    //商品类型属性添加页面
    Route::get('goods/attr/add', 'Admin\goodsAttrController@add')->name('admin.goods.attr.add');

    //商品类型属性执行添加
    Route::post('goods/attr/doAdd', 'Admin\goodsAttrController@doAdd')->name('admin.goods.attr.doAdd');

    //商品类型属性修改页面
    Route::get('goods/attr/edit/{id}', 'Admin\goodsAttrController@edit')->name('admin.goods.attr.edit');

    //商品类型属性执行修改
    Route::post('goods/attr/doEdit', 'Admin\goodsAttrController@doEdit')->name('admin.goods.attr.doEdit');

    //商品类型属性删除
    Route::get('goods/attr/del/{id}', 'Admin\goodsAttrController@del')->name('admin.goods.attr.del');




    /*--------------------------------------[商品类型属性列表]--------------------------------------*/


    /*--------------------------------------[商品列表]--------------------------------------*/

    //商品列表
     Route::get('goods/list','Admin\GoodsController@list')->name('admin.goods.list');

     //商品列表接口数据
     Route::any('goods/data/list','Admin\GoodsController@getGoodsData')->name('admin.goods.data.list');

     //修改商品的属性
     Route::post('goods/change/attr','Admin\GoodsController@changeAttr')->name('admin.goods.change.attr');

     // 商品添加
     Route::get('goods/add','Admin\GoodsController@add')->name('admin.goods.add');

      //商品添加操作
     Route::post('goods/store','Admin\GoodsController@store')->name('admin.goods.store');

     // 商品添加
     Route::get('goods/edit/{id}','Admin\GoodsController@edit')->name('admin.goods.edit');

      //商品添加操作
     Route::post('goods/save','Admin\GoodsController@doEdit')->name('admin.goods.save');

     // 商品删除
     Route::get('goods/del/{id}','Admin\GoodsController@del')->name('admin.goods.del');

     //商品相册的数据
     Route::post('goods/gallery/list/{goods_id}','Admin\GoodsGalleryController@getGallery')->name('admin.goods.gallery.list');

     // 商品相册删除
     Route::get('goods/gallery/del/{id}','Admin\GoodsGalleryController@del')->name('admin.goods.gallery.del');



     //商品sku编辑页面
     Route::get('goods/sku/edit/{id}','Admin\GoodsSkuController@edit')->name('admin.goods.sku.edit');

     //商品SKU执行添加
     Route::post('goods/sku/doEdit','Admin\GoodsSkuController@doEdit')->name('admin.goods.sku.doEdit');

     //商品SKU属性列表接口
     Route::any('goods/sku/attr/{goods_id}','Admin\GoodsSkuController@getSkuAttr')->name('admin.goods.sku.attr');

     //商品属性值
     Route::any('goods/attr/value/{id}','Admin\GoodsSkuController@getAttrValues')->name('admin.goods.attr.value');

     Route::any('goods/sku/list/bind/{goods_id}','Admin\GoodsSkuController@getSkuList')->name('admin.goods.sku.list.bind');





    /*--------------------------------------[商品列表]--------------------------------------*/

    /*--------------------------------------[商品评论]--------------------------------------*/

    //商品评论列表
    Route::get('comment/list/{goods_id}','Admin\CommentController@list')->name('admin.comment.list');

     //商品评论删除
    Route::get('comment/del/{goods_id}','Admin\CommentController@del')->name('admin.comment.del');


    /*--------------------------------------[商品评论]--------------------------------------*/



    /*--------------------------------------[系统管理]--------------------------------------*/


    //支付方式列表
    Route::get('payment/list','Admin\PaymentController@list')->name('admin.payment.list');


    //支付方式添加页面
    Route::get('payment/add','Admin\PaymentController@add')->name('admin.payment.add');


    //支付方式执行添加
    Route::post('payment/doAdd','Admin\PaymentController@doAdd')->name('admin.payment.doAdd');


    //支付方式添加页面
    Route::get('payment/edit/{id}','Admin\PaymentController@edit')->name('admin.payment.edit');


    //支付方式执行修改
    Route::post('payment/doEdit','Admin\PaymentController@doEdit')->name('admin.payment.doEdit');

    //支付方式删除
    Route::get('payment/del/{id}','Admin\PaymentController@del')->name('admin.payment.del');



    //配送方式列表
    Route::get('shipping/list','Admin\ShippingController@list')->name('admin.shipping.list');
    //配送添加页面
    Route::get('shipping/add','Admin\ShippingController@add')->name('admin.shipping.add');

    //执行添加
    Route::post('shipping/doAdd','Admin\ShippingController@doAdd')->name('admin.shipping.doAdd');
    //配送删除
    Route::get('shipping/del/{id}','Admin\ShippingController@del')->name('admin.shipping.del');

    /*--------------------------------------[系统管理]--------------------------------------*/


    /*--------------------------------------[会员管理]--------------------------------------*/

    //列表
    Route::get('member/list','Admin\MemberController@list')->name('admin.member.list');
    
    //详情
    Route::get('member/detail/{id}','Admin\MemberController@detail')->name('admin.member.detail');

    /*--------------------------------------[会员管理]--------------------------------------*/


    /*--------------------------------------[商品导入导出]--------------------------------------*/

     //商品导入的页面
     Route::get('goods/import','Admin\GoodsController@import')->name('admin.goods.import');
     Route::post('goods/doImport','Admin\GoodsController@doImport')->name('admin.goods.doImport');
     
     //商品导出
     Route::any('goods/export','Admin\GoodsController@export')->name('admin.goods.export');

    /*--------------------------------------[商品导入导出]--------------------------------------*/




    /*--------------------------------------[运维管理]--------------------------------------*/


    //活动配置列表
    Route::get('activity/list','Admin\ActivityController@list')->name('admin.activity.list');


    //活动配置添加页面
    Route::get('activity/add','Admin\ActivityController@add')->name('admin.activity.add');


    //活动配置执行添加
    Route::post('activity/doAdd','Admin\ActivityController@doAdd')->name('admin.activity.doAdd');

    //活动配置修改页面
    Route::any('activity/edit/{id}','Admin\ActivityController@edit')->name('admin.activity.edit');

    //活动配置执行修改
    Route::post('activity/doEdit','Admin\ActivityController@doEdit')->name('admin.activity.doEdit');

    //活动配置删除
    Route::get('activity/del/{id}','Admin\ActivityController@del')->name('admin.activity.del');



    //地区列表
    Route::get('region/list/{id?}','Admin\RegionController@list')->name('admin.region.list');


    //地区添加页面
    Route::get('region/add','Admin\RegionController@add')->name('admin.region.add');


    //地区执行添加
    Route::post('region/doAdd','Admin\RegionController@doAdd')->name('admin.region.doAdd');


    //地区删除
    Route::get('region/del/{id}','Admin\RegionController@del')->name('admin.region.del');


    /*--------------------------------------[运维管理]--------------------------------------*/

});