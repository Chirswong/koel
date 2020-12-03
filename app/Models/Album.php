<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function App\Helpers\album_cover_url;
use function App\Helpers\album_cover_path;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Album extends Model
{
    use HasFactory;
}
