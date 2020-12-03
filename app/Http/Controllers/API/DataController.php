<?php

namespace App\Http\Controllers\API;

use App\Application;
use App\Models\User;
use Illuminate\Http\Request;
use App\Service\iTunesService;
use App\Service\LastfmService;
use App\Service\YouTubeService;
use App\Service\MediaCacheService;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\SettingRepository;
use App\Repositories\PlaylistRepository;
use App\Repositories\InteractionRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Service\ApplicationInformationService;

class DataController extends Controller
{
    private const RECENTLY_PLAYED_EXCERPT_COUNT = 7;

    private $lastfmService;
    private $youTubeService;
    private $iTunesService;
    private $mediaCacheService;
    private $settingRepository;
    private $playlistRepository;
    private $interactionRepository;
    private $userRepository;
    private $applicationInformationService;

    /** @var User*/
    private $currentUser;

    public function __construct(
        Authenticatable $currentUser,
        LastfmService $lastfmService,
        iTunesService $iTunesService,
        YouTubeService $youTubeService,
        UserRepository $userRepository,
        MediaCacheService $mediaCacheService,
        SettingRepository $settingRepository,
        PlaylistRepository $playlistRepository,
        InteractionRepository $interactionRepository,
        ApplicationInformationService $applicationInformationService
    )
    {
        $this->currentUser    = $currentUser;
        $this->iTunesService  = $iTunesService;
        $this->lastfmService  = $lastfmService;
        $this->userRepository = $userRepository;
        $this->youTubeService = $youTubeService;
        $this->mediaCacheService  = $mediaCacheService;
        $this->settingRepository  = $settingRepository;
        $this->playlistRepository = $playlistRepository;
        $this->interactionRepository = $interactionRepository;
        $this->applicationInformationService = $applicationInformationService;
    }

    public function index()
    {
        return response()->json($this->mediaCacheService->get() +
            [
                'settings' => $this->currentUser->is_admin ? $this->settingRepository->getAllAsKeyValueArray() : [],
                'playlists' => $this->playlistRepository->getAllByCurrentUser(),
                'interactions' => $this->interactionRepository->getAllByCurrentUser(),
                'recentlyPlayed' => $this->interactionRepository->getRecentlyPlayed(
                    $this->currentUser,
                    self::RECENTLY_PLAYED_EXCERPT_COUNT
                ),
                'users' => $this->currentUser->is_admin ? $this->userRepository->getAll() : [],
                'currentUser' => $this->currentUser,
                'useLastfm' => $this->lastfmService->used(),
                'useYouTube' => $this->youTubeService->enabled(),
                'useiTunes' => $this->iTunesService->used(),
                'allowDownload' => config('koel.download.allow'),
                'supportsTranscoding' => config('koel.streaming.ffmpeg_path')
                && is_executable(config('koel.streaming.ffmpeg_path')),
                'cndUrl' => app()->staticUlr(),
                'currentVersion' => Application::KOEK_VERSION,
                'latestVersion' => $this->currentUser->is_admin
                ? $this->applicationInformationService->getLatestVersionNumber()
                    : Application::KOEK_VERSION
            ]
        );
    }
}
