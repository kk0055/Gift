<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
        'image2',
        'category_id'
    ];

    public function user()
    {
       return $this->belongsTo(User::class,);
    }
  
    public function messages()
    {
       return $this->hasMany(Message::class,);
    }

    public function category()
    {
        // 投稿は1つのカテゴリーに属する
        return $this->belongsTo(Category::class);
    }
   
}
