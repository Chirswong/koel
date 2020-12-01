<?php

namespace App;

use Illuminate\Foundation\Application as IlluminateApplication;

/**
 * Class Application
 * @package App
 */
class Application extends IlluminateApplication
{

    const KOEK_VERSION = 'v4.4.0';

    /**
     * @param null $name
     * @return string
     */
    public function staticUrl(?string $name = null): string
    {
        $cdnUrl = trim(config('koel.cnd.url'), '/ ');

        return $cdnUrl ? $cdnUrl . '/' . trim(ltrim($name, '/')) : trim(asset($name));
    }

}
