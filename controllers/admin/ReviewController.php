<?php

class ReviewController
{
    private $comment;
    private $user;
    private $product;
    public function __construct()
    {
        $this->comment = new Review();
        $this->user = new User();
        $this->product = new Product();
    }

    public function index(){
        $title = "Danh sách Bình Luận";
        $view = "reviews/index";
        $comments = $this->comment->getAll();
        
        return require_once PATH_VIEW_ADMIN_MAIN;
    }
    public function show(){
        $title = "Danh sách Bình Luận";
        $view = "reviews/index";
        $comment = $this->comment->getAll();
        
        return require_once PATH_VIEW_ADMIN_MAIN;
    }
    
}
