@extends('admin.layouts.master')
{{-- این صفحه از صفحه مستر  پوشه بندی ویو /ادمین/ لیوت/ مستر گرفته شده است --}}

@section('head-tag')
{{--  جهت تگ های که داخل هد می نویسیم  در نظر گرفته شده است --}}
<title>دسته بندی</title>
{{-- این جا تگ تایتل متفاوت باید باشد و متناسب با ااین صفحه دسته بندی نام داشته باشد به همین جهت داخل سشن نوشته می شود --}}
@endsection

@section('content')
{{-- به قسمت محتوا قسمت های پایین را باید اضافه کنیم --}}

<nav aria-label="breadcrumb">
    {{--  جهت منو افقی خانه/بخش فروش/ دسته بندی در نظر گرفتهاست که در بالای صفحه نمایش داده می شود --}}
    {{-- ازکدهای اماده بوت استرپ می توان استفاده کرد --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.content.category.index')}}">دسته بندی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد دسته بندی</li>
    </ol>
  </nav>



  {{-- کدهای بوت استرپ برای صفحه ایجاد --}}
  <section class="row"> 
  
    <section class="col-12">
        <section class="main-body-container">
            {{-- زیر صفحه سفید این قسمت --}}
            <section class="main-body-container-header">
                <h5>
                  ایجاد دسته بندی
                  {{-- در بالا نمایش همین کلمه --}}
                </h5>
            </section>



            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

{{-- در این قسمت یک کلید برای بازگشت یه صفحه اصلی دسته بندی با استفاده از کدهای بوت استرپ قرار داده شده است و روت مورد نظر نیزه به اچ رف داده شده است --}}


            <section>
                {{-- یک فرم برای ارسال اطلاعات اماه میکنیم متد آن باید پست باشد --}}
                <form action="{{ route('admin.content.category.store') }}" method="post" enctype="multipart/form-data" id="form">
                
                <!-- با اضافه کردن مولتی پارت میتوان قابلیت انتقال فایل را به فرم میدهد -->
                    @csrf
                    {{-- مختصرCross Site Request Forgery می‌باشد
                        جلوگیری از حمله هکرها در هنگام ذخیره اطلاعات
                        
                        --}}
                    <section class="row">
                        {{-- آماده سازی فیلدهایی که باید در این قسمت پر شود --}}

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="name">نام دسته</label>
                                {{-- لیبل فقط جهت مشخص کردن عنوان فیلد --}}
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ old('name') }}">

                                {{--  یک ورودی از جنس تکست یا متن   و
                                    old name یعنی مقدار های قبلی که به این تکست اختصاص داده شده قابل دسترس باشد --}}
                            </div>

                            @error('name')
                            {{-- ارور کلی اگر مقادیر به درستی وارد نشود یا اینپوت مشکلی داشته باشد --}}

                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="tags">تگ ها</label>
                                <input type="hidden" class="form-control form-control-sm"  name="tags" id="tags" value="{{ old('tags') }}">
                                <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                </select>
                            </div>
                            @error('tags')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            {{-- فیلد مربوط به وضعیت فعال یا غیر فعال بودن --}}
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="" class="form-control form-control-sm" id="status">
                                    {{-- اگر مقدار ولیو 0 باشد و مقدار قبلی آن برابر صفر باشد انتخاب شود در غیر این صورت غیر فعال --}}
                                    <option value="0" @if(old('status') == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>



                        <section class="col-12 col-md-6 my-2">
                        <div class="form-group">
                                <label for="image">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="image" id="image">
                            </div>
                            @error('image')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>



                        

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">توضیحات</label>
                                <textarea name="description" id="description"  class="form-control form-control-sm" rows="6">
                                    {{ old('description') }}
                                </textarea>
                            </div>
                            @error('description')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>


                        <section class="col-12 my-3">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')


<!-- ------------------------------------------------------------------------------- -->
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
    </script>


<!-- -------------------------------------------------------------------- -->
   
   
   <script>
        $(document).ready(function () {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;

            if(tags_input.val() !== null && tags_input.val().length > 0)
            {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                placeholder : 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');


            $('#form').submit(function ( event ){
                if(select_tags.val() !== null && select_tags.val().length > 0){
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>

    <!-- ------------------------------------------------------------------------------  -->

@endsection
