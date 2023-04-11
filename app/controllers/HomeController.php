<?php

namespace controllers;

use services\ArtistService;
use services\ContentService;
use services\LocationService;

class HomeController
{

    private ContentService $contentService;
    private ArtistService $artistService;
    private LocationService $locationService;

    public function __construct()
    {
        $this->contentService = new ContentService();
        $this->artistService = new ArtistService();
        $this->locationService = new LocationService();
    }

    public function index()
    {
        $home = $this->contentService->getOneFromTitle('Home');
        $danceHighlights = $this->contentService->getAllHighlightsNonFood(2);
        $jazzHighlights = $this->contentService->getAllHighlightsNonFood(3);
        $foodHighlights = $this->contentService->getAllHighlightsFood();
        require_once __DIR__ . '/../views/home/index.php';
    }

    public function about()
    {
        $about = $this->contentService->getOneFromId(6);
        require_once __DIR__ . '/../views/home/about.php';
    }

    public function artist()
    {
        $artists = $this->artistService->getAll();
        require_once __DIR__ . '/../views/home/artist.php';
    }

    public function venues()
    {
        $venues = $this->locationService->getAll();
        require_once __DIR__ . '/../views/home/venues.php';
    }

    public function showContent(string $title)
    {
        $content = $this->contentService->getOneFromTitle($title);
        require_once __DIR__ . '/../views/home/showContent.php';
    }
}
