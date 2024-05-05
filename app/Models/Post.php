<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'admin_id'
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');    
    }
}
