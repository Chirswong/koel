<?php

namespace App\Models;

use App\Traits\CanFilterByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Interaction extends Model
{
    use HasFactory;
    use CanFilterByUser;

    protected $casts = [
        'liked' => 'boolean',
        'play_count' => 'integer',
    ];
    protected $guarded = ['id'];
    protected $hidden = ['id', 'user_id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
