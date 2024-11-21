<?php

class HomeController
{
    private $home;
    private $card;
    public function __construct()
    {
        $this->home = new Home();
        $this->card = new Cart();
    }
    public function index()
    {
        $view = "user/home";
        $data = $this->home->renderProductsAndTypes();
        $categories = $this->home->renderCategory();
        require_once PATH_VIEW_CLIENT . 'main.php';
    }
    public function goToCart()
    {
        $view = 'user/cart';
        $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;
        $cartItems = $this->card->getCart($userId);
        // debug($cartItems);die;
        require_once PATH_VIEW_CLIENT_MAIN;
    }
}
