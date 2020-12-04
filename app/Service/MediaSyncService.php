<?php
namespace App\Service;

use Psr\Log\LoggerInterface;
use App\Services\HelperService;
use App\Services\FileSynchronizer;
use App\Repositories\SongRepository;
use Symfony\Component\Finder\Finder;
use App\Console\Commands\SyncCommand;
use App\Repositories\AlbumRepository;
use App\Services\MediaMetadataService;
use App\Repositories\ArtistRepository;
use App\Repositories\SettingRepository;

class MediaSyncService
{
    /**
     * All applicable tags in a media file that we cater for.
     * Note that each isn't necessarily a valid ID3 tag name.
     *
     * @var array
     */
    public const APPLICABLE_TAGS = [
        'artist',
        'album',
        'title',
        'length',
        'track',
        'disc',
        'lyrics',
        'cover',
        'mtime',
        'compilation',
    ];

    private $mediaMetadataService;
    private $songRepository;
    private $helperService;
    private $fileSynchronizer;
    private $finder;
    private $artistRepository;
    private $albumRepository;
    private $settingRepository;
    private $logger;

    public function __construct(
        Finder $finder,
        LoggerInterface $logger,
        HelperService $helperService,
        SongRepository $songRepository,
        AlbumRepository $albumRepository,
        ArtistRepository $artistRepository,
        FileSynchronizer $fileSynchronizer,
        SettingRepository $settingRepository,
        MediaMetadataService $mediaMetadataService
    ) {
        $this->finder = $finder;
        $this->logger = $logger;
        $this->helperService = $helperService;
        $this->songRepository = $songRepository;
        $this->albumRepository = $albumRepository;
        $this->fileSynchronizer = $fileSynchronizer;
        $this->artistRepository = $artistRepository;
        $this->settingRepository = $settingRepository;
        $this->mediaMetadataService = $mediaMetadataService;
    }

    /**
     * Tags to be synced.
     *
     * @var array
     */
    protected $tags = [];

    /**
     * Sync the media. Oh sync the media.
     *
     * @param string[]    $tags        The tags to sync.
     *                                 Only taken into account for existing records.
     *                                 New records will have all tags synced in regardless.
     * @param bool        $force       Whether to force syncing even unchanged files
     * @param SyncCommand $syncCommand the SyncMedia command object, to log to console if executed by artisan
     *
     * @throws Exception
     */
    public function sync(
        $mediaPath = null,
        array $tags = [],
        bool $force = false,
        SyncCommand $syncCommand)
    {

    }
}
