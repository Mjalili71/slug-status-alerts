<?php

use App\Http\Controllers\Admin\Content\ContentCategoryController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

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
//نصب پکیج الرت ها 

//بعد از نصب بوت استرپ یک فایل فشرده وجد دارد چندین فایل وجودارد

//الرت سکشن ها و تست ها با بوت استرپ نصب می شود



//سوییت الرت در لاراول
// در سایت sourceforg.net  
// پکیج را دانلود کرده و فایل های آن را باید داخل 
//public/admin/aset فایل ها رو بگذارید
// در لیوت هد و مستر و اسکریپت لینک های مورد نظر را بگذارید

//ویوهای مربوط به الرت ها را در داخل پوشه
//ویوها/ ادمین /الرت   می گذاریم 


//جهت پنل ادمین یک روت گروهی ایجاد میکنیم و آن را به قسمت های مختلف تبدیل میکنیم 

Route::prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');// روت صفحه اصلی پنل ادمین 

 Route::prefix('market')->namespace('Market')->group(function(){

    //category
    Route::prefix('category')->group(function(){

        Route::get('/',[CategoryController::class,'index'])->name('admin.market.category.index');
        Route::get('/create',[CategoryController::class,'create'])->name('admin.market.category.create');
        Route::post('/store',[CategoryController::class,'store'])->name('admin.market.category.store');
        Route::get('/edit/{productCategory}',[CategoryController::class,'edit'])->name('admin.market.category.edit');
        Route::put('/update/{productCategory',[CategoryController::class,'update'])->name('admin.market.category.update');
        Route::delete('/destroy/productCategory',[CategoryController::class,'destroy'])->name('admin.market.category.destroy');

    });

 });

 Route::prefix('content')->namespace('Content')->group(function () {
    
    //دومین قسمت روت محتوا می باشد که به قسمت های مختلف تقسیم می شود

    //category

    Route::prefix('category')->group(function () {// دسته بندی  محتوا اولین گروه روت ایجاد شده می باشد
        Route::get('/', [ContentCategoryController::class, 'index'])->name('admin.content.category.index');//صفحه اولیه دسته بندی 
        Route::get('/create', [ContentCategoryController::class, 'create'])->name('admin.content.category.create');// روت ایجاد دسته بندی 
        Route::post('/store', [ContentCategoryController::class, 'store'])->name('admin.content.category.store');//روت ذخیره سازی
        Route::get('/edit/{postCategory}', [ContentCategoryController::class, 'edit'])->name('admin.content.category.edit');// روت ویرایش 
        Route::put('/update/{postCategory}', [ContentCategoryController::class, 'update'])->name('admin.content.category.update');//روت آپدیت
        Route::delete('/destroy/{postCategory}', [ContentCategoryController::class, 'destroy'])->name('admin.content.category.destroy');//روت دیلیت
        Route::get('/status/{postCategory}', [ContentCategoryController::class, 'status'])->name('admin.content.category.status');// روت وضعیت 
    });
 });
});