@extends('admin.layouts.master')

@section('head-tag')
<title>دسته بندی</title>
@endsection




@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.home') }}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسته بندی</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    دسته بندی
                </h5>
            </section>

            <!-- -----------------------------------alert------------------------------ -->


            <!-- هر وقت خواتستی از آلرت سکشن ها استفاده کنی این کد رو باید در هر چایی ک خواستی بزاری تا برات به نمایش داده بشه  -->

            <section class="row w-100">
                <!-- d-flex justify-content-center -->
                @include('admin.alerts.alert-section.success')
            </section>
            <!-- --------------------------------------------------------------------  -->


            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>







            <section class="table-responsive">
                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته بندی</th>
                            <th>توضیحات</th>
                            <th>اسلاگ</th>
                            <th>عکس</th>
                            <th>تگ ها</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>

                    <tbody>


                        <!-- اینا همه با compact ارسال شده است و  اصلا نیازی نیس include کنیم  -->
                        <!-- در ضمن $postCategory حاوی اطلاعات بسیار کاملی میباشد از هر لحاظ -->

                        @foreach ($postCategories as $key => $postCategory)





                        <tr>

                            <th>{{ $key += 1 }}</th>
                         



                            <td>{{ $postCategory->name }}</td>

                            <td>{{ $postCategory->description }}</td>

                            <td>{{ $postCategory->slug }}</td>



                            <!-- helpers = در لاراول توابعی تعریف شده که به صورت سراسری در کل پروژه لاراول قابل دسترس هستند. توابعی مثل route یا dd که احتمالا خیلی از توسعه دهندگان لاراول با اون ها آشنایی دارن. برای فراخوانی توابع نیاز به نمونه سازی از کلاس خاصی ندارید و این توابع به صورت غیرشی گرا قابل استفاده هستند. -->



                            <td>
                                <img src="{{ asset($postCategory->image) }}" alt="" width="100" height="50">
                                <!-- <img src="#" alt="images" width="100" height="50"> -->
                            </td>


                            <td>{{ $postCategory->tags }}</td>


                            <td>
                                <!-- وضعیت -->
                                {{-- وقتی روی  تغییر وضعیت کلیک شد 
                                    تابع جاوا اسکریپت آن چنچ فراخوانی می شود و آیدی اون دسته بندی رو هم باخودش می برد --}}


                                <label>
                                    <input id="{{ $postCategory->id }}" onchange="changeStatus({{ $postCategory->id }})" data-url="{{ route('admin.content.category.status', $postCategory->id) }}" type="checkbox" @if ($postCategory->status === 1)
                                    checked
                                    @endif>
                                </label>


                            </td>


                            <td class="width-16-rem text-left">
                                <!-- setting  -->
                                {{-- جهت ویرایش و ادیت  آیدی را هم میبرد تا بدانیم کدام باید ویرایش و یا حذف شود --}}
                                <a href="{{ route('admin.content.category.edit', $postCategory->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>

                                <form class="d-inline" action="{{ route('admin.content.category.destroy', $postCategory->id) }}" method="post">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                </form>
                            </td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection


@section('script')





<script type="text/javascript">
    function changeStatus(id) {// به این تابع آیدی اون دسته بندی که انتخاب شده رو میده که بدونیم رو کدام میخواهیم تغییر ایجاد کنیم
        var element = $("#" + id)//متغیر به نام المنت  / کد جی کوئری /آیدی به اضافه هشتگ
        var url = element.attr('data-url')//   آیدی که دادیم را بچسبان به آن دیتا یو ار ال
        var elementValue = !element.prop('checked');
        //یک متغیر داریم آیدی که دادیم اگر چک شده باشه عکسش رو میزاریم و برعکس

        $.ajax({// درخواست ای جکس انباط برقرار کنه با لاروال 
            url: url,//هر در خواست ای جکس یک یو ارل داره
            type: "GET",//یک گت داره// در خواست ای جکس تایپ آن همیشه گت است
            success: function(response) {// یک ساکسس داره// هر زمان که کارت انجام شد بیا اینت کارای پایین رو انجام بده
                if (response.status) {// اگر استاتوس من ترو 
                    if (response.checked) {// و اگر ریسپانس آن چک شود
                        element.prop('checked', true);// اگر چک بود  ترو شود
                        successToast('دسته بندی  با موفقیت فعال شد')
                    } else {
                        element.prop('checked', false);//اگر چک نبود فالس شود
                        successToast('دسته بندی با موفقیت غیر فعال شد')
                    }
                } else {// اگر استاتوس ای جکس فالس بود
                    element.prop('checked', elementValue);//همان وضعیت قبلی بماند
                    errorToast('هنگام ویرایش مشکلی بوجود امده است')
                }
            },
            error: function() {
                element.prop('checked', elementValue);
                errorToast('ارتباط برقرار نشد')
            }
        });




        function successToast(message) {

            var successToastTag = '<section class="toast" data-delay="5000">\n' +
                '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                '<strong class="ml-auto">' + message + '</strong>\n' +
                '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</section>\n' +
                '</section>';

            $('.toast-wrapper').append(successToastTag);
            $('.toast').toast('show').delay(5500).queue(function() {
                $(this).remove();
            })
        }

        function errorToast(message) {

            var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                '<strong class="ml-auto">' + message + '</strong>\n' +
                '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</section>\n' +
                '</section>';

            $('.toast-wrapper').append(errorToastTag);
            $('.toast').toast('show').delay(5500).queue(function() {
                $(this).remove();
            })
        }
    }
</script>



@include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
{{-- وقتی رو باتووم دیلیت کلیک شد  در فرم بالا کلاس دیلیت رو مشخص می کنیم --}}

@endsection