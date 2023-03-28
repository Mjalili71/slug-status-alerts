<!DOCTYPE html>
<html lang="en">




<head>
    {{-- وارد ادمین لیوت و فایل هد تگ شو همه رو بیار اینجا --}}
    @include('admin.layouts.head-tag')

    @yield('head-tag')
{{-- یلید میگذاریم تا هر جایی دیگه خواستیم از این ها چیزی اضافه تر بگذاریم با یک سشن فراخوانی و عمل مورد نظر را آن جا انجام دهیم --}}
{{-- همیشه یلید را استفاده کنید --}}
</head>





<body dir="rtl">

    @include('admin.layouts.header')

{{-- قسمت هدر از لیوت را باز می کند --}}







    <section class="body-container">

        @include('admin.layouts.sidebar')

{{-- قسمت ساید بار --}}


        <section id="main-body" class="main-body">

            @yield('content')
            {{-- جهت محتواهای استفاده شده در هر صفحه --}}

        </section>


    </section>




    @include('admin.layouts.script')

{{-- لینک های جاوا اسکریپت استفاده شده در پروژه فراخوانی می شود --}}

    @yield('script')

{{-- اکر چیزی بخواهیم اضافه کنیم --}}

    <section class="toast-wrapper flex-row-reverse">

        @include('admin.alerts.toast.success')
        {{-- هرجایی بتونیم از تست الرت ها استفاده کنیم --}}
    </section>


    @include('admin.alerts.sweetalert.success')

   {{-- بتوانبم در هرجایی تز پروژه از سویت الرت استفاده کنیم  --}}


</body>

</html>