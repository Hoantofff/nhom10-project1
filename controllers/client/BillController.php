<?php

class BillController
{
    private $home;
    private $bill;
    public function __construct()
    {
        // $this->home = new Home();
        $this->bill = new Bill();
    }
    public function index()
    {
        $view = "user/billList";
        $data = $this->bill->getAll();
        // $categories = $this->home->renderCategory();
        require_once PATH_VIEW_CLIENT . 'main.php';
    }
    public function goToCart()
    {
        $view = "user/cart";
        require_once PATH_VIEW_CLIENT . "main.php";
    }
}