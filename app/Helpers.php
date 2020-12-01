<?php

namespace App\Helpers;

function album_cover_path($fileName)
{
    return public_path(config('koel.album_cover_dir') . $fileName);
}

function album_cover_url($fileName){

}
