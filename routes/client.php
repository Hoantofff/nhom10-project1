<?php


$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => (new HomeController)->index(),

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
    // Bill
    'bill-index' => (new BillController)->index(),
    // 'bill-detail' => (new BillController)->show(),
};
