<?php
// Fix config
class HomeController
{
    private $home;
    public function __construct()
    {
        $this->home = new Home();
    }
    public function index()
    {
        $view = "user/home";
        $data = $this->home->renderProductsAndTypes();
        $categories = $this->home->renderCategory();
        require_once PATH_VIEW_CLIENT . 'main.php';
    }
}
