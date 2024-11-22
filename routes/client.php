<?php


$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => (new HomeController)->index(),
    'test-show' => (new TestController)->show(),
    "goToCate" => (new HomeController)->goToCate(),
    "goToBrand" => (new HomeController)->goToBrand(),
    "search" => (new HomeController)->renderSuggest(),
    "startSearching" => (new HomeController)->startSearching(),
    // CART
    "goToCart" => (new HomeController)->goToCart(),
    //Authen
    'show-form-login'       => (new AuthenController)->showFormLogin(),
    'login'                 => (new AuthenController)->login(),
    'logout'                => (new AuthenController)->logout(),

    'show-form-register' => (new AuthenController)->showFormRegister(),
    'register' => (new AuthenController)->register(),
    // HOME CLIENT
    "productDetail" => (new ProductDetailController)->goToProductDetail(),
};
