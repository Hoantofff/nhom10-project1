<?php
class Cart extends BaseModel
{
    protected $table = "cart";

    // Lấy sản phẩm trong giỏ theo product_id
    public function getByProductId($productId, $userId)
    {
        $sql = "SELECT * FROM $this->table WHERE product_id = :productId AND user_id = :userId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addToCart($productId,$userId, $quantity)
    {
        $sql = "INSERT INTO $this->table (product_id,user_id, quantity) VALUES (:product_id,:user_id, :quantity)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateQuantity($productId,$user_id, $quantity)
    {
        $sql = "UPDATE $this->table SET quantity = :quantity WHERE product_id = :productId AND user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getCart($userId)
    {
        $sql = "SELECT pd.name as pd_name,
                       pd.image as pd_image,
                       pd.id as pd_id,
                       pd.price as pd_price,
                       pd.sale_price as pd_sale_price, 
                       u.name AS u_name,
                       u.id as u_id,
                       c.quantity as c_quantity
                FROM cart AS c
                INNER JOIN users AS u ON u.id = c.user_id
                INNER JOIN products AS pd ON pd.id = c.product_id
                WHERE u.id = :user_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function clearCart($userId) {
        // Xóa tất cả sản phẩm trong giỏ hàng sau khi đặt hàng
        $sql = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['user_id' => $userId]);
    }
}
