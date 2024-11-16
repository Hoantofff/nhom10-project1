<?php

class HomeController {
<<<<<<< HEAD
    private $home;

    public function index()
    {
        $view = "user/home";
        $data = $this->home->renderProductsAndTypes();
        $categories = $this->home->renderCategory();
        require_once PATH_VIEW_CLIENT_MAIN;
    }
}

=======
    public function index(){
        require_once PATH_VIEW_CLIENT . 'home.php';
    }
}
>>>>>>> parent of 33f6b4a (Merge pull request #10 from Hoantofff/DucManh)
