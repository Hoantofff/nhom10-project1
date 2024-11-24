<?php class CartController
{
    private $cart;
    public function __construct()
    {
        $this->cart = new Cart();
    }
    public function addProductToCart()
    {

        $productId = $_POST['product_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;
        $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;

        if (!$userId) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = 'Bạn cần đăng nhập để vào giỏ hàng';
            header("Location: " . BASE_URL . "?act=show-form-login");
            exit();
        }


        if (!$productId) {
            $_SESSION['error'][] = "Lỗi: Không tìm thấy sản phẩm.";
            header("Location: " . BASE_URL);
            exit();
        }

        $existingItem = $this->cart->getByProductId($productId, $userId);
        // debug($existingItem);die;
        if ($existingItem) {
            $newQuantity = $existingItem['quantity'] + $quantity;
            $this->cart->updateQuantity($productId, $userId, $newQuantity);
        } else {

            $this->cart->addToCart($productId, $userId, $quantity);
        }

        header("Location: " . BASE_URL . "?act=goToCart");
        exit();
    }
    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $products = $_POST['products'] ?? [];
            $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;

            if (!$userId) {
                $_SESSION['error'][] = 'Bạn cần đăng nhập để thực hiện thao tác này.';
                header("Location: " . BASE_URL . "?act=show-form-login");
                exit();
            }
            if (empty($products)) {
                $_SESSION['error'][] = 'Không có sản phẩm nào để cập nhật.';
                header('Location: ' . BASE_URL . '?act=goToCart');
                exit();
            }
            foreach ($products as $product) {
                $productId = $product['product_id'] ?? null;
                $quantity = $product['quantity'] ?? null;

                if ($productId && is_numeric($quantity) && $quantity > 0) {
                    $cartItem = $this->cart->getByProductId($productId, $userId);
                    if ($cartItem) {
                        $this->cart->updateQuantity($productId, $userId, $quantity);
                        $_SESSION['success'][] = 'Số lượng sản phẩm đã được cập nhật.';
                    } else {
                        $_SESSION['error'][] = 'Sản phẩm không có trong giỏ.';
                    }
                } else {
                    $_SESSION['error'][] = 'Số lượng không hợp lệ.';
                }
            }

            header('Location: ' . BASE_URL . '?act=goToCart');
            exit;
        }
    }
}
