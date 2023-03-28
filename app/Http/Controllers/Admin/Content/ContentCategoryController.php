<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;

class ContentCategoryController extends Controller
{

    // نصب پکیج  عکس 

    //composer require intervention/image 
    //دستور بالا را در ترمینال قرار می دهیم تا پکیج اینترویشن نصب شود
    //و بعد از کدهای آماده که در قسمت  استور برای ذخیره عکس استفاده می کنیم 
    //و بعد سرویس های ایمیج  سرویس فعال و یوز شود
    //اگر فعال نشد   ویژوال استودیو را ببندیم و باز کنید تا اصلاح شود


    public function index()
    {

        $postCategories = PostCategory::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.category.index', compact('postCategories'));
    }




    public function create() // تابع ایجاد دسته بندی 
    {

        return view('admin.content.category.create'); // به من ویو /ادمین /کانتکت/کتگوری/کریت را نشان بده
    }

    public function store(PostCategoryRequest $request, ImageService $imageService) // اعتبار سنجی شود و از سرویس ایمیج استفاده شود
    {
        $inputs = $request->all(); //داخل ورودی ریکوست ها وارد شود
        // پکیج عکس  شروع

        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->save($request->file('image'));

            if ($result === false) {
                return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        // اتمام پکیج عکس

        $postCategory = PostCategory::create($inputs); //این ورودی ها در داخل   متغیر پست کتگوری  ریخته می شود

        // این متد در دیتابیس عملیات ذخیره سازی رو انجام میده

        return redirect()->route('admin.content.category.index')->with('alert-section-success', 'این دسته بندی با موفیت در دیتابیس ذخیره گردید');
        //برگرد به روت  ادمین کانتکت  کتگوری  ایندکس  
        //و الرت را با موفقیت در دیتا  بیس ذخیره شد فراخوانی می کنیم
    }





//تابع ادیت 
    public function edit(PostCategory $postCategory)// از مدل پست کتگوری یک شی درست کن 
    {
        return view('admin.content.category.edit', compact('postCategory'));// برو به ویو ادمین کانتکت کتگوری ادیت و این داده ها را اخل آن بریز
    }


// تابع آپدیت 


    public function update(PostCategoryRequest $request, PostCategory $postCategory, ImageService $imageService)//اعتبارسنجی ورودی ها و استفاده از سرویس عکس و شی از مدل
    {


        $inputs = $request->all();//تمام ریکوست ها داخل اینپوت ریخته شود


        //پکیج عکس
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->save($request->file('image'));

            if ($result === false) {
                return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        //پکیج عکس 


        $postCategory->update($inputs);//ورودی های داخل اینپوت آپدیت شده و داخل متغیر پست کتگوری ریخته شود
       
     return redirect()->route('admin.content.category.index')->with('toast-success', 'این دسته بندی با موفقیت ویرایش شد ');
     //برگرد به روت ادکین کانتت کتگوری ایندکس و الرت مورد نظر رو هم فراخوانی کن 
    }
// تابع دیلیت 

    public function destroy(PostCategory $postCategory)//شی از مدل
    {
        $result = $postCategory->delete();//تمام مقادیر داخل متغیر دیلیت و نتیجه داخل ریزالت 
        return redirect()->route('admin.content.category.index')->with('swal-success', 'این دسته بندی با موفقیت حذف شد'); // میره از مسترکه قبلا فراخوانی شده است 
       //برگرد به روت ادمین کانتنت / کتگوری / ایندکس
        //بعد به پوشه ویو/ادمین/الرت/ سوییت الرت/ساکسس و 
    }



    public function status(PostCategory $postCategory) //آیدی رو فرستادیم
    {

        // این کلا کارش با دیتابیسه چیزی رو لازم نیس به ویو ها بفرسته 

        $postCategory->status = $postCategory->status == 0 ? 1 : 0; //  یک آیدی که فرستادم وضعیت رو چک کن اگر دسته بندی من 0 بود یک بشه اگر یک بود صفر شود 

        $result = $postCategory->save(); // تغییرات ذخیره شود

        if ($result) { //  درست بود $result==trueاگر نتیجه 

            if ($postCategory->status == 0) { //اگر استاتوس من شد صفر 

                return response()->json(['status' => true, 'checked' => false]); // برگردون ریسپانس را به ایندکس وضعیت ای جکس ترو باشد  چکد آن باید غیر انتخاب یا فالس باشد
            } else { // اگر استاتوس من یک شد
                return response()->json(['status' => true, 'checked' => true]); //استاتوس خود جی اکس ترو باشد یعنی عملیات انجام شده و تغییر رخ داده چکد را باید یک کند
            }
        } else {

            return response()->json(['status' => false]); // اگر دستور جی اکس انجام نشده باشد استاتوس آن فالس باشد
        }
    } // این استاتوس خود جی اکس است نه استاتوس که اینجا داشتیم

}
