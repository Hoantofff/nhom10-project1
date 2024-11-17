<?php class ProductDetailController
{
    private $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function goToProductDetail()
    {
        $view = 'user/productDetail';
        $id = $_GET['id'];
        $cateId = $_GET['cateId'];
        $product = $this->product->getById($id);
        $sameProducts = $this->product->sameProduct($id, $cateId);
        return require_once PATH_VIEW_CLIENT . 'main.php';
    }
}
