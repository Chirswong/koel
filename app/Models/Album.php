<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function App\Helpers\album_cover_url;
use function App\Helpers\album_cover_path;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Album extends Model
{
    use HasFactory;

    const UNKNOWN_ID = 1;
    const UNKNOWN_NAME = 'Unknown Album';
    const UNKNOWN_COVER = 'unknown-album.ong';

    protected $casts = ['artist_id' => 'integer'];
    protected $hidden = ['updated_at'];
    protected $guarded = ['id'];
    protected $appends = ['is_compilation'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function getIsUnknownAttribute(): bool
    {
        return $this->id === self::UNKNOWN_ID;
    }
}
