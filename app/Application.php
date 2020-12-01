<?php

namespace App;

use Illuminate\Foundation\Application as IlluminateApplication;

class Application extends IlluminateApplication
{

    const KOEK_VERSION = 'v4.4.0';

    public function staticUrl($name = null)
    {
        $cdnUrl = trim(config('koel.cnd.url'), '/ ');

        return $cdnUrl ? $cdnUrl . '/' . trim(ltrim($name, '/')) : trim(asset($name));
    }

}
