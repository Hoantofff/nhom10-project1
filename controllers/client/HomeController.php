<?php

class HomeController
{
    private $home;
    private $card;
    private $slider;
    private $bill;
    private $billDetail;
    public function __construct() 
    {
        $this->home = new Home();
        $this->card = new Cart();
        $this->slider = new Slider();
        $this->bill = new Bill();
        $this->billDetail = new BillDetail();
    }
    public function index()
    {
        $view = "user/home";
        $sliders= $this->slider->getAll();
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
    public function goToBill()
    {
        $view = 'user/billList';
        $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;
        $cartItems = $this->card->getCart($userId);
        // debug($cartItems);die;
        require_once PATH_VIEW_CLIENT_MAIN;
    }
    public function goToBillDetail()
    {
        $view = 'user/billDetail';
        $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;
        $cartItems = $this->card->getCart($userId);
        // debug($cartItems);die;
        require_once PATH_VIEW_CLIENT_MAIN;
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
                    echo "<div class='hover:opacity-50 cursor-pointer' data-id='" . $result['id'] . "'>" . $result['name'] . "</div><br/>";
                }
            } else {
                echo "<div>Không tìm thấy sản phẩm có tên:" . $productName . "</div>";
            }
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
    public function goToPayment()
    {
        $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;
        $view = "user/payment";
        $cartItems = $this->card->getCart($userId);
        require_once PATH_VIEW_CLIENT . "main.php";
    }
    public function billDetail()
    {
        $id=$_GET['id'];
        $billData= $this->bill->getByID($id);
        $client_id = $_SESSION['user_client']['id'];
        $cartItems = $this->billDetail->getBillDetails($id);
        $view = "user/billDetail";
        require_once PATH_VIEW_CLIENT . "main.php";
    }
}
