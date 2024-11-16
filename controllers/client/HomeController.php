<?php

class HomeController {
    public function index(){
        require_once PATH_VIEW_CLIENT . 'home.php';
    }
<<<<<<< HEAD
    public function index()
    {
        $view = "user/home";
        $data = $this->home->renderProductsAndTypes();
        $categories = $this->home->renderCategory();
        require_once PATH_VIEW_CLIENT_MAIN;
    }
}
=======
}
>>>>>>> 2bd1cdd55fb0cd3e76f596da7008474139abcafd
