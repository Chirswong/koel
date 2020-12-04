<?php

namespace App\Service;

use SplFileInfo;
use App\Models\Song;
use App\Repositories\SongRepository;
use Symfony\Component\Finder\Finder;
use Illuminate\Contracts\Cache\Repository as Cache;

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

    public function __construct(
        Cache $cache,
        Finder $finder,
        HelperService $helperService,
        SongRepository $songRepository
    )
    {
        $this->cache = $cache;
        $this->finder = $finder;
        $this->helperService = $helperService;
        $this->songRepository = $songRepository;
    }

    /**
     * @param $path
     * @return $this
     */
    public function setFile($path)
    {
        $this->splFileInfo = $path instanceof SplFileInfo ? $path : new SplFileInfo($path);

        try {
            $this->fileModifiedTime = $this->splFileInfo->getMTime();
        } catch (\Exception $exception) {
            $this->fileModifiedTime = time();
        }

        $this->filePath = $this->splFileInfo->getPathname();
        $this->fileHash = $this->helperService->getFileHash($this->filePath);
        $this->song = $this->songRepository->getOneById($this->fileHash);
        $this->syncError = null;

        return $this;
    }

    public function sync(array $tags, bool $force = false)
    {
        if (!$this->isFileNewOrChanged() && !$force){

        }
    }

    public function isFileChanged()
    {
        return !$this->isFileNew() && $this->song->mtime !== $this->fileModifiedTime;
    }

    public function isFileNewOrChanged()
    {
        return $this->isFileNew() || $this->isFileChanged();
    }

    public function isFileNew()
    {
        return !$this->song;
    }
}
