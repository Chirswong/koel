<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\LastfmService;
use App\Service\MediaCacheService;
use Illuminate\Http\Request;

class DataController extends Controller
{


    private $lastfmService;
    private $youTubeService;
    private $iTunesService;
    private $mediaCacheService;
    private $settingRepository;
    private $playlistRepository;
    private $interactionRepository;
    private $userRepository;
    private $applicationInformationService;


    public function __construct(
        LastfmService $lastfmService,
        MediaCacheService $mediaCacheService
    )
    {
        $this->lastfmService = $lastfmService;
        $this->mediaCacheService = $mediaCacheService;
    }
    public function index()
    {

    }
}
