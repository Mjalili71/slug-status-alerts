@if(session('swal-success'))
{{--  اگر جایی swal-success صدا زده شد  --}}
{{-- که با with معمولا صدا زده می شود --}}

<script>
    $(document).ready(function() {
        // کدهای داخل خود سایت هست توسط حاوا اسکرپت 
        // زمانی که سشن اکی شد
        Swal.fire({//فایر بزند صدا بزند (متد خود سوییت الرت)
            title: 'عملیات با موفقیت انجام شد',// بگخ عملیات با موفقیت انجام شد
            text: '{{ session('swal - success ') }}',//سشن  که با ویت تعریف شده است (متن کنار ویت)
            icon: 'success',//آیکون ساکسس
            confirmButtonText: 'اوکیه',//کانفریم اوکی باشد
        });
    });
</script>

@endif