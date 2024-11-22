<?php

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
    public function goToCart()
    {
        $view = "user/cart";
        require_once PATH_VIEW_CLIENT . "main.php";
    }
    public function goToCate()
    {
        $view = "user/productType";
        $idCate = $_GET['idCate'];
        $data = $this->home->getProductsAndTypes($idCate);
        $categories = $this->home->renderCategory();
        require_once PATH_VIEW_CLIENT . 'main.php';
    }
    public function goToBrand()
    {
        $view = "user/productType";
        $idCate = $_GET['idCate'];
        $idBrand = $_GET['idBrand'];
        $data = $this->home->getByBrand($idBrand, $idCate);
        $categories = $this->home->renderCategory();
        require_once PATH_VIEW_CLIENT . 'main.php';
    }
    public function renderSuggest()
    {
        if (isset($_POST['nameProduct'])) {
            $productName = $_POST['nameProduct'];
            $result = $this->home->findProduct($productName);
            if (!empty($result)) {
                foreach ($result as $result) {
                    echo "<div class = 'hover:opacity-50 cursor-pointer'>" . $result['name'] . "</div> <br/>";
                }
            }
        } else {
            echo "Not found product";
        }
    }
    public function startSearching()
    {
        $view = "user/searchProduct";
        $categories = $this->home->renderCategory();
        $productName = $_POST['nameProduct'];
        $products = $this->home->findProduct($productName);
        require_once PATH_VIEW_CLIENT . 'main.php';
    }
}
