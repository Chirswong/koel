<?php

namespace App\Service;

use App\Models\Setting;
use Psr\Log\LoggerInterface;
use App\Repositories\SongRepository;
use Symfony\Component\Finder\Finder;
use App\Console\Commands\SyncCommand;
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
        FileSynchronizer $fileSynchronizer,
        SettingRepository $settingRepository,
    )
    {
        $this->finder = $finder;
        $this->logger = $logger;
        $this->helperService = $helperService;
        $this->songRepository = $songRepository;
        $this->fileSynchronizer = $fileSynchronizer;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Tags to be synced.
     *
     * @var array
     */
    protected $tags = [];


    public function sync($mediaPath = null, $tags = [], $force = false, SyncCommand $syncCommand)
    {
        $this->setSystemRequirements();
        $this->tags($tags);

        $results = [
            'success' => [],
            'bad_files' => [],
            'unmodified' => [],
        ];

        $songPaths = $this->gatherFiles($mediaPath ?: Setting::get('media_path'));

        if ($syncCommand) {
            $syncCommand->createProgressBar(count($songPaths));
        }

        foreach ($songPaths as $path) {
            $result = $this->fileSynchronizer->setFile($path)->sync($this->tags, $force);


        }
    }

    private function setSystemRequirements()
    {
        if (!app()->runningInConsole()) {
            set_time_limit(config('koel.sync.timeout'));
        }

        if (config('koel.memory_limit')) {
            ini_set('memory_limit', config('koel.memory_limit') . 'M');
        }
    }

    public function setTags($tags = [])
    {
        $this->tags = array_intersect($tags, self::APPLICABLE_TAGS) ?: self::APPLICABLE_TAGS;
    }

    public function gatherFiles($path)
    {
        return iterator_to_array(
            $this->finder->create()
                ->ignoreUnreadableDirs()
                ->ignoreDotFiles((bool)config('koel.ignore_dot_files'))
                ->files()
                ->followLinks()
                ->name('/\.(mp3|ogg|m4a|flac)$/i')
                ->in($path)
        );
    }
}
