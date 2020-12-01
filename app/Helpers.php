<?php

namespace App\Helpers;

function album_cover_path($fileName)
{
    return public_path(config('koel.album_cover_dir') . $fileName);
}

function album_cover_url(string $fileName): string
{
    return app()->staticUrl(config('koel.album_cover_dir').$fileName);
}

function album_thumbnail_url($filename)
{
    return album_cover_url($filename);
}

function artist_image_path($filename)
{
    return public_path(config('koel.artist_image_dir') . $filename);
}

function artist_image_url($filename){
    return;
}
