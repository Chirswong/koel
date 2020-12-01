<?php

namespace App;

use InvalidArgumentException;
use Illuminate\Foundation\Application as IlluminateApplication;

/**
 * Class Application
 * @package App
 */
class Application extends IlluminateApplication
{

    const KOEK_VERSION = 'v4.4.0';


    /**
     * @param string $file
     * @param string|null $manifestFile
     * @return string
     */
    public function rev(string $file, string $manifestFile = null): string
    {
        static $manifest = null;

        $manifestFile = $manifestFile ?: public_path('mix-manifest.json');

        if ($manifest === null){
            $manifest = json_decode(file_get_contents($manifestFile),true);
        }

        if (isset($manifest[$file])){
            return file_exists(public_path('hot'))
                ? "http://localhost:8080{$manifest[$file]}"
                : $this->staticUrl("{$manifest[$file]}");
        }

        throw new InvalidArgumentException("File {$file} not defined in asset manifest");
    }

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
