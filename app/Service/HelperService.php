<?php

namespace App\Service;

class HelperService
{
    public function getFileHash($path)
    {
        return md5(config('app.key') . $path);
    }

}
