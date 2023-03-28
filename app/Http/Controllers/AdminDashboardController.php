<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller// کنترلر  جهت نمایش صفحه اصلی پنل ادمین
{
    public function index()
    {
       
        
        return view('admin.index');// به من  از پوشه /ویو /ادمین/ ایندکس را نشان بده
    }
}
