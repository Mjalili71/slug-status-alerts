<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PostCategory extends Model
{
    use HasFactory,Sluggable,SoftDeletes ;
  
    
    public function sluggable(): array
    {
        
        return[
            'slug' =>[
                'source' => 'name'
            ]
        ];
        
    }

    



   
  
    
    // با Cast های لاراول می‌تونیم بطور خودکار تبدیل اطلاعات داشته باشیم. یعنی فریم‌ورک بصورت خودکار عملیات تبدیل اطلاعات برای ذخیره توی دیتابیس یا نمایش اونها رو انجام میده
    protected $casts = ['image' => 'array'];
//   نوع آرایه هست favorite  ز   توی کد بالا، گفتیم که از
//   ، لاراول بطور خودکار قبل از ثبت اطلاعات،
//   اونها رو از آرایه به رشته تبدیل می‌کنه و همچنین قبل از نمایش، اون رو به آرایه تبدیل می‌کنه



    // فیلدهایی که حتما باید در دیتابیس ذخیره شوند 
    
    protected $fillable = ['name', 'description', 'slug', 'image', 'status', 'tags'];

    

}
