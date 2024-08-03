<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['logo', 'name', 'status'];
    
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
