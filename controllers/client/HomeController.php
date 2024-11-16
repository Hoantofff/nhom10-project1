<?php

// Fix config
class HomeController
{
    private $home;
    public function __construct()
    {
        $this->home = new Home();


class HomeController {
    public function index(){
        require_once PATH_VIEW_CLIENT . 'home.php';

    }
}