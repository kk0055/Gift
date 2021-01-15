<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['message','user_id','is_read','item_id','send','receive'];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    Public function items()
{
    return $this->belognsTo(Item::class,'item_id');;
} 
}
