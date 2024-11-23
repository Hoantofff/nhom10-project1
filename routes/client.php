<?php


$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => (new HomeController)->index(),

    //Authen
    'show-form-login'       => (new AuthenController)->showFormLogin(),
    'login'                 => (new AuthenController)->login(),
    'logout'                => (new AuthenController)->logout(),

    'show-form-register' => (new AuthenController)->showFormRegister(),
    'register' => (new AuthenController)->register(),

    // HOME CLIENT
    "productDetail" => (new ProductDetailController)->goToProductDetail(),
    // Bill
    'bills-index' => (new BillController)->index(),
    'bills-show' => (new BillController)->show(),
    'bills-edit' => (new BillController)->edit(),
    'bills-edit' => (new BillController)->update(),
    'bills-delete' => (new BillController)->delete(),
    // CART
    "goToCart" => (new HomeController)->goToCart(),
    'add-to-cart' => (new CartController)->addProductToCart(),
    'update-cart' => (new CartController)->updateCart()
}; 
