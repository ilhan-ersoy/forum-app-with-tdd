<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Channel;

class Thread extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function path()
    {
        return '/threads/' . $this->channel->slug . '/' . $this->id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }


}
