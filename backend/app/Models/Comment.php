<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'feed_back_id',
        'comments',
    ];

    public function feedback()
    {
        return $this->belongsTo(FeedBack::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
