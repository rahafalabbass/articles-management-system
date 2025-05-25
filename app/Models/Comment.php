<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'article_id',
        'content',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(user::class);
    }


    public function article(){
        return $this->belongsTo(Article::class);
    }
}
