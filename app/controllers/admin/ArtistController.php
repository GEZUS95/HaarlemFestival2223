<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use models\Artist;
use services\ArtistService;
use services\UserService;

class ArtistController {

    private RedirectHelper $redirectHelper;
    private ArtistService $artistService;
    private UserService $userService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->artistService = new ArtistService();
        $this->userService = new UserService();

        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function showArtists(){
        $model = $this->artistService->getAll();
        require_once __DIR__ . '/../../views/admin/artist/artists.php';
    }

    public function newArtist(){
        require_once __DIR__ . '/../../views/admin/artist/newartist.php';
    }

    public function newArtistPost() {
        $artist = $this->artistService->postArtist($_POST);
        $this->artistService->insertOne($artist);
        $this->redirectHelper->redirect("/admin/artists");
    }

    public function updateArtist(int $artistId){
        $artist = $this->artistService->getOneById($artistId);
        require_once __DIR__ . '/../../views/admin/artist/updateartist.php';
    }

    public function updateArtistPost(int $artistId){
        $artist = $this->artistService->postArtist($_POST);
        $artist->setId($artistId);
        $this->artistService->updateOne($artist);
        $this->redirectHelper->redirect("/admin/artists");
    }

    public function deleteArtist(int $artistId) {
        $this->artistService->deleteOne($artistId);
        $this->redirectHelper->redirect("/admin/artists");
    }
}