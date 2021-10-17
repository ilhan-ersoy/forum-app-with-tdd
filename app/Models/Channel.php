<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Thread;

class Channel extends Model
{
    use HasFactory;
    protected $guarded = [];


    // Override
    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
