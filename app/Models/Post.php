<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\User;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'title', 'content', 'image', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}