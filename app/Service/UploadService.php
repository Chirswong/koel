<?php

namespace App\Service;

use App\Exceptions\MediaPathNotSetException;
use App\Models\Setting;
use function Functional\memoize;
use Illuminate\Http\UploadedFile;

class UploadService
{
    private const UPLOAD_DIRECTORY = '__KOEL_UPLOADS__';

    private $fileSynchronizer;

    public function __construct(FileSynchronizer $fileSynchronizer)
    {
        $this->fileSynchronizer = $fileSynchronizer;
    }

    /**
     * @param UploadedFile $file
     * @throws MediaPathNotSetException
     */
    public function handleUploadedFile(UploadedFile $file)
    {
        $targetFileName = $this->getTargetFileName($file);
        $file->move($this->getUploadDirectory(), $targetFileName);

        $targetPathName = $this->getUploadDirectory() . $targetFileName;
        $this->fileSynchronizer->setFile($targetPathName);
        $result = $this->fileSynchronizer->sync();
    }

    /**
     * @throws MediaPathNotSetException
     */
    public function getUploadDirectory()
    {
        return memoize(static function () {
            $mediaPath = Setting::get('media_path');

            if (!$mediaPath) {
                throw new MediaPathNotSetException();
            }

            return $mediaPath . DIRECTORY_SEPARATOR . self::UPLOAD_DIRECTORY . DIRECTORY_SEPARATOR;
        });
    }

    public function getTargetFileName(UploadedFile $file)
    {
        if (!file_exists($this->getUploadDirectory() . $file->getClientOriginalName())) {
            return $file->getClientOriginalName();
        }

        return $this->getUniqueHash() . '_' . $file->getClientOriginalName();
    }

    public function getUniqueHash()
    {
        return substr(sha1(uniqid()), 0, 6);
    }
}
