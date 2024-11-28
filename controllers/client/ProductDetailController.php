<?php class ProductDetailController
{
    private $product;
    private $review;
    private $variant;
    public function __construct()
    {
        $this->product = new Product();
        $this->review = new Review();
        $this->variant = new Variant();
    }
    public function goToProductDetail()
    {
        $view = 'user/productDetail';
        $script = 'variantProductDetail';
        $id = $_GET['id'];
        $cateId = $_GET['cateId'];
        $product = $this->product->getById($id);
        $sameProducts = $this->product->sameProduct($id, $cateId);
        $review = $this->review->getReviewById($id);
        $variantsBySize = $this->variant->getAllSizes($id);
        $variantsByColor = $this->variant->getAllColors($id); 
        $variants = $this->variant->getProductId($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleComment($id, $cateId);
        }

        return require_once PATH_VIEW_CLIENT . 'main.php';
    }
    private function handleComment($productId, $cateId)
    {
        if (empty($_SESSION['user_client']) && empty($_SESSION['user_admin'])) {
            $_SESSION['error'][] = 'Bạn cần đăng nhập để bình luận.';
            $this->redirectToDetail($productId, $cateId);
        }

        $data = $_POST;
        $errors = $this->validateComment($data);

        if (!empty($errors)) {
            $_SESSION['error'] = $errors;
            $this->redirectToDetail($productId, $cateId);
        }

        $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'];
        $commentData = [
            'user_id' => $userId,
            'product_id' => $productId,
            'comment' => htmlspecialchars(trim($data['comment']), ENT_QUOTES, 'UTF-8')
        ];

        $this->review->insert($commentData);
        $this->redirectToDetail($productId, $cateId);
    }
    private function validateComment($data)
    {
        $errors = [];
        if (empty($data['comment'])) {
            $errors[] = 'Bình luận không được để trống.';
        }
        if (strlen($data['comment']) > 500) {
            $errors[] = 'Bình luận không được dài quá 500 ký tự.';
        }
        return $errors;
    }

    private function redirectToDetail($productId, $cateId)
    {
        header('Location: ' . BASE_URL . '?act=productDetail&id=' . $productId . '&cateId=' . $cateId);
        exit;
    }
}
