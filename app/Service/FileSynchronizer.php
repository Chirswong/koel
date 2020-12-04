<?php

namespace App\Service;
use App\Models\Song;
use SplFileInfo;

class FileSynchronizer
{

    public const SYNC_RESULT_SUCCESS = 1;
    public const SYNC_RESULT_BAD_FILE = 2;
    public const SYNC_RESULT_UNMODIFIED = 3;

    private $getID3;
    private $mediaMetadataService;
    private $helperService;
    private $songRepository;
    private $cache;
    private $finder;

    /**
     * @var SplFileInfo
     */
    private $splFileInfo;

    /**
     * @var int
     */
    private $fileModifiedTime;

    /**
     * @var string
     */
    private $filePath;

    /**
     * A (MD5) hash of the file's path.
     * This value is unique, and can be used to query a Song record.
     *
     * @var string
     */
    private $fileHash;

    /**
     * The song model that's associated with the current file.
     *
     * @var Song|null
     */
    private $song;

    /**
     * @var string|null
     */
    private $syncError;

    public function getFile($path)
    {
        $this->splFileInfo = $path instanceof SplFileInfo ? $path : new SplFileInfo($path);

        try {
            $this->fileModifiedTime = $this->splFileInfo->getMTime();
        }catch (\Exception $exception){
            $this->fileModifiedTime = time();
        }

        $this->filePath = $this->splFileInfo->getPathname();
        $this->fileHash = $this->getFileHash($this->filePath);
        $this->song = null;
    }

    public function getFileHash(string $path): string
    {
        return md5(config('app.key').$path);
    }
}
