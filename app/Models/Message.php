<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['message','user_id','status','item_id'];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
